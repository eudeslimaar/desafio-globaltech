<?php

namespace repositories;

use config\Database;
use PDO;

class DashboardRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getTotalClientes(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM clientes";
        $stmt = $this->db->query($sql);
        return (int)$stmt->fetchColumn();
    }

    public function getTotalPedidos(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos";
        $stmt = $this->db->query($sql);
        return (int)$stmt->fetchColumn();
    }

    public function getTotalDetalles(): int
    {
        $sql = "SELECT COUNT(*) AS total FROM detalle_pedido";
        $stmt = $this->db->query($sql);
        return (int)$stmt->fetchColumn();
    }

    public function getCountByEstado(): array
    {
        $sql = "SELECT estado, COUNT(*) AS total FROM pedidos GROUP BY estado";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
