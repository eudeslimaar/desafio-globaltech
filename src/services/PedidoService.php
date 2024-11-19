<?php

namespace services;

use Exception;
use repositories\ClienteRepository;
use repositories\PedidoRepository;

class PedidoService {
    private PedidoRepository $pedidoRepository;
    private ClienteRepository $clienteRepository;

    public function __construct() {
        $this->pedidoRepository = new PedidoRepository();
        $this->clienteRepository = new ClienteRepository();
    }

    public function obtenerTodosPedidos(): array
    {
        return $this->pedidoRepository->obtenerTodosPedidos();
    }

    public function obtenerPedidosPorCliente(int $clienteId): array {
        return $this->pedidoRepository->obtenerPedidosPorCliente($clienteId);
    }

    public function obtenerPedidosRecientes(): array {
        return $this->pedidoRepository->obtenerPedidosRecientes();
    }

    public function calcularTotalPedidos(int $clienteId): array
    {
        return $this->pedidoRepository->calcularTotalPedidos($clienteId);
    }

    public function getPedidoById(int $id)
    {
        return $this->pedidoRepository->getPedidoById($id);
    }

    public function actualizarEstadoPedido(int $pedidoId, string $estado): bool
    {
        return $this->pedidoRepository->actualizarEstadoPedido($pedidoId, $estado);
    }

    public function procesarArchivo(string $filePath): bool {
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            throw new Exception('Error al abrir el archivo.');
        }

        fgetcsv($handle); // Saltar la línea de encabezado
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $clienteId = isset($data[0]) ? (int)$data[0] : null;
            $fechaPedido = $data[1] ?? null;
            $estado = $data[2] ?? null;
            $productos = isset($data[3]) ? json_decode($data[3], true) : null;

            if ($clienteId === null || $fechaPedido === null || $estado === null || $productos === null) {
                continue;
            }

            $this->pedidoRepository->cargarPedidoConDetalles($clienteId, $fechaPedido, $estado, json_encode($productos));
        }
        fclose($handle);
        return true;
    }

    public function cargarPedidoConDetalles(int $clienteId, string $fechaPedido, string $estado, array $productos): bool
    {

        $cliente = $this->clienteRepository->findById($clienteId);
        if (!$cliente) {
            throw new Exception('Cliente no encontrado.');
        }

        foreach ($productos as $producto) {
            if (empty($producto['producto']) || empty($producto['cantidad']) || empty($producto['precio'])) {
                throw new Exception('Todos los productos deben contener nombre, cantidad y precio.');
            }
            if (!is_numeric($producto['cantidad']) || !is_numeric($producto['precio'])) {
                throw new Exception('La cantidad y el precio deben ser valores numéricos.');
            }
        }
        return $this->pedidoRepository->insertarPedidoConDetalles($clienteId, $fechaPedido, $estado, $productos);
    }
}
