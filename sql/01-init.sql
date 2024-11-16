CREATE DATABASE IF NOT EXISTS gestion_pedidos_EUDES_LIMA CHARACTER SET latin1 COLLATE latin1_general_ci;
USE gestion_pedidos_EUDES_LIMA;


CREATE TABLE IF NOT EXISTS clientes
(
    id             INT AUTO_INCREMENT PRIMARY KEY,
    nombre         VARCHAR(100) NOT NULL,
    email          VARCHAR(100) NOT NULL,
    fecha_registro DATE         NOT NULL
    );

CREATE TABLE IF NOT EXISTS pedidos
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id   INT,
    fecha_pedido DATE        NOT NULL,
    estado       VARCHAR(20) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes (id)
    );

CREATE INDEX idx_cliente_id ON pedidos (cliente_id);

CREATE TABLE IF NOT EXISTS detalle_pedido
(
    id              INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id       INT,
    producto        VARCHAR(100)   NOT NULL,
    cantidad        INT            NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos (id)
    );

CREATE INDEX idx_pedido_id ON detalle_pedido (pedido_id);