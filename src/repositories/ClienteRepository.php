<?php

namespace repositories;

use config\Database;
use models\Cliente;
use PDO;
use PDOException;

require_once __DIR__ . '/../../vendor/autoload.php';

class ClienteRepository
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findAll(): array
    {
        try {
            $sql = "SELECT id, nombre, email, fecha_registro FROM clientes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $clientes = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $clientes[] = new Cliente(
                    $row['id'],
                    $row['nombre'],
                    $row['email'],
                    $row['fecha_registro']);
            }

            return $clientes;
        } catch (PDOException $e) {
            error_log("Error al obtener todos los clientes: " . $e->getMessage());
            return [];
        }
    }

    public function findById(int $id): ?Cliente
    {
        try {
            $sql = "SELECT id, nombre, email, fecha_registro FROM clientes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Cliente($row['id'], $row['nombre'], $row['email'], $row['fecha_registro']);
            }
        } catch (PDOException $e) {
            error_log("Error al buscar cliente por ID: " . $e->getMessage());
        }

        return null;
    }

    public function create(string $nombre, string $email): ?Cliente
    {
        try {
            $sql = "INSERT INTO clientes (nombre, email, fecha_registro) VALUES (:nombre, :email, CURDATE())";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $this->findById($this->db->lastInsertId());
            }
        } catch (PDOException $e) {
            error_log("Error al crear cliente: " . $e->getMessage());
        }

        return null;
    }

    public function update(int $id, string $nombre, string $email): bool
    {
        try {
            $sql = "UPDATE clientes SET nombre = :nombre, email = :email WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar cliente: " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM clientes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar cliente: " . $e->getMessage());
            return false;
        }
    }
}
