<?php

namespace repositories;

use config\Database;
use models\Pedido;
use PDO;
use PDOException;

class PedidoRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getPedidoById(int $pedidoId): ?Pedido {
        try {
            $sql = "SELECT p.id AS pedido_id,
                       p.cliente_id,
                       p.fecha_pedido,
                       p.estado,
                       dp.producto,
                       dp.cantidad,
                       dp.precio_unitario
                FROM pedidos p
                INNER JOIN detalle_pedido dp ON p.id = dp.pedido_id
                WHERE p.id = :pedidoId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pedidoId', $pedidoId, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Pedido(
                    $row['pedido_id'],
                    $row['cliente_id'],
                    $row['fecha_pedido'],
                    $row['estado'],
                    $row['producto'],
                    $row['cantidad'],
                    $row['precio_unitario']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener pedido por ID: " . $e->getMessage());
            return null;
        }
    }

    public function obtenerTodosPedidos(): array
    {
        try {
            $sql = "CALL obtener_todos_pedidos()";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $pedidos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = new Pedido(
                    $row['pedido_id'],
                    $row['cliente_id'],
                    $row['fecha_pedido'],
                    $row['estado'],
                    $row['producto'],
                    $row['cantidad'],
                    $row['precio_unitario']
                );
            }

            return $pedidos;
        } catch (PDOException $e) {
            error_log("Error al obtener todos los pedidos: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPedidosPorCliente(int $clienteId): array {
        try {
            $sql = "CALL obtener_pedidos_cliente(:clienteId)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
            $stmt->execute();

            $pedidos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = new Pedido(
                    $row['pedido_id'],
                    $clienteId,
                    $row['fecha_pedido'],
                    $row['estado'],
                    $row['producto'],
                    $row['cantidad'],
                    $row['precio_unitario']
                );
            }

            return $pedidos;
        } catch (PDOException $e) {
            error_log("Error al ejecutar el procedimiento almacenado: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPedidosRecientes(): array {
        try {
            $sql = "
            SELECT p.id AS pedido_id,
                   p.cliente_id,
                   p.fecha_pedido,
                   p.estado,
                   dp.producto,
                   dp.cantidad,
                   dp.precio_unitario
            FROM pedidos p
            INNER JOIN detalle_pedido dp ON p.id = dp.pedido_id
            WHERE p.fecha_pedido >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            ORDER BY p.fecha_pedido DESC
            LIMIT 30
        ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $pedidos = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pedidos[] = new Pedido(
                    $row['pedido_id'],
                    $row['cliente_id'],
                    $row['fecha_pedido'],
                    $row['estado'],
                    $row['producto'],
                    $row['cantidad'],
                    $row['precio_unitario']
                );
            }
            return $pedidos;
        } catch (PDOException $e) {
            error_log("Error al obtener pedidos recientes: " . $e->getMessage());
            return [];
        }
    }

    public function calcularTotalPedidos(int $clienteId): array
    {
            $pedidos = $this->obtenerPedidosPorCliente($clienteId);

            $totalCantidad = 0;
            $totalPrecio = 0.0;

            foreach ($pedidos as $pedido) {
                $totalCantidad += $pedido->getCantidad();
                $totalPrecio += $pedido->getCantidad() * $pedido->getPrecioUnitario();
            }
            return [
                'totalCantidad' => $totalCantidad,
                'totalPrecio' => $totalPrecio
            ];
    }

    public function actualizarEstadoPedido(int $pedidoId, string $estado): bool
    {
        if (empty($pedidoId) || !in_array($estado, ['pendiente', 'enviado', 'entregado'])) {
            return false;
        }

        try {
            $sql = "CALL actualizar_estado_pedido(:pedidoId, :estado)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pedidoId', $pedidoId, PDO::PARAM_INT);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar el estado del pedido: " . $e->getMessage());
            return false;
        }
    }

    public function cargarPedidoConDetalles(int $clienteId, string $fechaPedido, string $estado, string $productos): bool {
        try {
            $sql = "CALL cargar_pedido_con_detalles(:clienteId, :fechaPedido, :estado, :productos)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
            $stmt->bindParam(':fechaPedido', $fechaPedido, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':productos', $productos, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao carregar pedido com detalhes: " . $e->getMessage());
            return false;
        }
    }

    public function inserirPedidoConDetalles(int $clienteId, string $fechaPedido, string $estado, array $productos): bool
    {
        try {
            $this->db->beginTransaction();

            $sqlPedido = "INSERT INTO pedidos (cliente_id, fecha_pedido, estado) VALUES (:clienteId, :fechaPedido, :estado)";
            $stmtPedido = $this->db->prepare($sqlPedido);
            $stmtPedido->bindParam(':clienteId', $clienteId, PDO::PARAM_INT);
            $stmtPedido->bindParam(':fechaPedido', $fechaPedido, PDO::PARAM_STR);
            $stmtPedido->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmtPedido->execute();

            $pedidoId = $this->db->lastInsertId();

            $sqlDetalhe = "INSERT INTO detalle_pedido (pedido_id, producto, cantidad, precio_unitario) VALUES (:pedidoId, :producto, :cantidad, :precio)";
            $stmtDetalhe = $this->db->prepare($sqlDetalhe);

            foreach ($productos as $producto) {
                $stmtDetalhe->bindParam(':pedidoId', $pedidoId, PDO::PARAM_INT);
                $stmtDetalhe->bindParam(':producto', $producto['producto'], PDO::PARAM_STR);
                $stmtDetalhe->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
                $stmtDetalhe->bindParam(':precio', $producto['precio'], PDO::PARAM_STR);
                $stmtDetalhe->execute();
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {

            $this->db->rollBack();
            error_log("Erro ao inserir pedido: " . $e->getMessage());
            return false;
        }
    }
}

