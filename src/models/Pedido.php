<?php

namespace models;

class Pedido {
    private int $id;
    private int $clienteId;
    private string $fechaPedido;
    private string $estado;
    private string $producto;
    private int $cantidad;
    private float $precioUnitario;

    public function __construct(
        int $id,
        int $clienteId,
        string $fechaPedido,
        string $estado,
        string $producto,
        int $cantidad,
        float $precioUnitario
    ) {
        $this->id = $id;
        $this->clienteId = $clienteId;
        $this->fechaPedido = $fechaPedido;
        $this->estado = $estado;
        $this->producto = $producto;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getClienteId(): int {
        return $this->clienteId;
    }

    public function getFechaPedido(): string {
        return $this->fechaPedido;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function getProducto(): string {
        return $this->producto;
    }

    public function getCantidad(): int {
        return $this->cantidad;
    }

    public function getPrecioUnitario(): float {
        return $this->precioUnitario;
    }
}
