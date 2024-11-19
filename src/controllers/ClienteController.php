<?php
namespace controllers;

use Exception;
use services\ClienteService;

require_once __DIR__ . '/../../vendor/autoload.php';

class ClienteController {
    private ClienteService $clienteService;

    public function __construct() {
        $this->clienteService = new ClienteService();
    }

    public function getAllClientes(): void
    {
        $clientes = $this->clienteService->getAllClientes();
        echo view('clientes.index', ['clientes' => $clientes]);
    }

    public function getClienteById($id): void
    {
        try {
            $cliente = $this->clienteService->getClienteById($id);
            echo view('clientes.detalles', ['cliente' => $cliente]);
        } catch (Exception $e) {
            http_response_code(404);
            echo view('404');
        }
    }

    public function createCliente(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'] ?? '';
        $email = $input['email'] ?? '';

        try {
            $clientes = $this->clienteService->createCliente($nombre, $email);
            echo json_encode(['status' => 'success', 'clientes' => $clientes]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function updateCliente($id): void
    {
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';

        try {
            $this->clienteService->updateCliente($id, $nombre, $email);
            echo json_encode(['status' => 'success', 'message' => 'Cliente actualizado con éxito']);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function deleteCliente($id): void
    {
        try {
            $this->clienteService->deleteCliente($id);
            echo json_encode(['status' => 'success', 'message' => 'Cliente eliminado con éxito']);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }

    public function editCliente($id): void
    {
        try {
            $cliente = $this->clienteService->getClienteById($id);
            if ($cliente) {
                echo view('clientes.editar', ['cliente' => $cliente]);
            } else {
                http_response_code(404);
                echo view('404');
            }
        } catch (\Exception $e) {
            http_response_code(500);
        }
    }

    public function clientesSinPedidos(): void
    {
        try {
            $clientes = $this->clienteService->obtenerClientesSinPedidos();
            
            if (!empty($clientes)) {
                echo view('clientes.inactivos', ['clientes' => $clientes]);
            } else {
                echo view('clientes.inactivos', ['mensaje' => 'No se encontraron clientes sin pedidos.']);
            }
        } catch (\Exception $e) {
            http_response_code(500);
        }
    }

}
