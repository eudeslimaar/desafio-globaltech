<?php

namespace controllers;

use Exception;
use services\ClienteService;
use services\PedidoService;

class PedidoController {
    private ClienteService $clienteService;
    private PedidoService $pedidoService;

    public function __construct() {
        $this->pedidoService = new PedidoService();
        $this->clienteService = new ClienteService();
    }

    public function obtenerTodosPedidos(): void
    {
        try {
            $pedidos = $this->pedidoService->obtenerTodosPedidos();

            if (empty($pedidos)) {
                http_response_code(404);
                echo view('pedidos.lista', ['message' => 'No se encontraron pedidos.']);
            } else {
                echo view('pedidos.index', ['pedidos' => $pedidos]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
        }
    }

    public function obtenerPedidosPorCliente($clienteId): void
    {
        try {
            $pedidos = $this->pedidoService->obtenerPedidosPorCliente($clienteId);
            $totales = $this->pedidoService->calcularTotalPedidos($clienteId);

            if (empty($pedidos)) {
                http_response_code(400);
                echo view('pedidos.lista', ['message' => 'No se encontraron pedidos para este cliente.']);
            } else {
                echo view('pedidos.lista', [
                    'pedidos'=> $pedidos,
                    'totalCantidad' => $totales['totalCantidad'],
                    'totalPrecio' => $totales['totalPrecio']
                ]);
            }
        } catch (\Exception) {
            http_response_code(500);
        }
    }

    public function obtenerPedidosRecientes(): void {
        try {
            $pedidos = $this->pedidoService->obtenerPedidosRecientes();

            if (empty($pedidos)) {
                http_response_code(404);
                echo view(404);
            } else {
                echo view('pedidos.recientes', ['pedidos' => $pedidos]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
        }
    }

    public function editEstadoPedido($id): void
    {
        try {
            $pedido = $this->pedidoService->getPedidoById($id);
            if ($pedido) {
                echo view('pedidos.editar', ['pedido' => $pedido]);
            } else {
                http_response_code(404);
                echo view('404', ['message' => 'Pedido no encontrado.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
        }
    }

    public function actualizarEstadoPedido($id): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $estado = $input['estado'] ?? '';

        try {
            $success = $this->pedidoService->actualizarEstadoPedido($id, $estado);
            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Estado del pedido actualizado con éxito.']);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el estado del pedido.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function cargarPedidoConDetalles(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
            return;
        }

        try {
            if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('Error al subir el archivo.');
            }

            $filePath = $_FILES['file']['tmp_name'];
            $fileType = $_FILES['file']['type'];

            // Validar tipo de archivo
            $allowedTypes = ['text/csv', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            if (!in_array($fileType, $allowedTypes)) {
                throw new Exception('Tipo de archivo no permitido.');
            }

            $result = $this->pedidoService->procesarArchivo($filePath);

            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Pedidos cargados con éxito.']);
            } else {
                throw new Exception('Error al cargar los pedidos.');
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function showFormularioCargar(): void
    {
        try {
            echo view('pedidos.upload');
        } catch (\Exception $e) {
            http_response_code(500);
            echo view('404', ['message' => 'Error al cargar la página de carga de pedidos.']);
        }
    }

    public function createPedidoForm($clienteId): void
    {
        try {
            $cliente = $this->clienteService->getClienteById($clienteId);
            if (!$cliente) {
                http_response_code(404);
                echo view('404', ['message' => 'Cliente no encontrado.']);
                return;
            }

            echo view('pedidos.nuevo', ['cliente' => $cliente]);
        } catch (Exception $e) {
            http_response_code(500);
            echo view('500', ['message' => 'Error al cargar el formulario para agregar pedido.']);
        }
    }

    public function storePedido($clienteId): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $fechaPedido = $input['fecha_pedido'] ?? '';
        $estado = $input['estado'] ?? '';
        $productos = $input['productos'] ?? [];

        try {
            $result = $this->pedidoService->cargarPedidoConDetalles($clienteId, $fechaPedido, $estado, $productos);
            if ($result) {
                echo json_encode(['status' => 'success', 'message' => 'Pedido creado con éxito.']);
            } else {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Error al crear el pedido.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
