<?php
namespace services;
use Exception;
use repositories\ClienteRepository;

require_once __DIR__ . '/../../vendor/autoload.php';


class ClienteService {
    private ClienteRepository $clienteRepository;

    public function __construct() {
        $this->clienteRepository = new ClienteRepository();
    }

    public function getAllClientes() {
        return $this->clienteRepository->findAll();
    }

    public function getClienteById($id) {
        return $this->clienteRepository->findById($id);
    }

    public function createCliente($nome, $email) {
        return $this->clienteRepository->create($nome, $email);
    }

    public function updateCliente($id, $nombre, $email): void {
        if (empty($nombre) || empty($email)) {
            throw new Exception('Nome e email são obrigatórios.');
        }
        $this->clienteRepository->update($id, $nombre, $email);
    }

    public function deleteCliente($id) {
        return $this->clienteRepository->delete($id);
    }
}
