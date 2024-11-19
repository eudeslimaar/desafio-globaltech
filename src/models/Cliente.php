<?php
namespace models;

class Cliente {
    public int $id;
    public string $nombre;
    public string $email;
    public string $fecha_registro;

    public function __construct($id = null, $nombre = null, $email = null, $fecha_registro = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->fecha_registro = $fecha_registro;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }

}

