USE gestion_pedidos_EUDES_LIMA;

DELIMITER //

CREATE PROCEDURE cargar_pedido_con_detalles(
    IN clienteId INT,
    IN fechaPedido DATE,
    IN estado VARCHAR(20),
    IN productos TEXT
)
BEGIN
    DECLARE pedidoId INT;
    DECLARE i INT DEFAULT 0;
    DECLARE totalProdutos INT;
    DECLARE produto VARCHAR(100);
    DECLARE quantidade INT;
    DECLARE precio DECIMAL(10, 2);

    INSERT INTO pedidos (cliente_id, fecha_pedido, estado)
    VALUES (clienteId, fechaPedido, estado);

    SET pedidoId = LAST_INSERT_ID();

    SET totalProdutos = JSON_LENGTH(productos);

    WHILE i < totalProdutos DO
            SET produto = JSON_UNQUOTE(JSON_EXTRACT(productos, CONCAT('$[', i, '].producto')));
            SET quantidade = JSON_UNQUOTE(JSON_EXTRACT(productos, CONCAT('$[', i, '].cantidad')));
            SET precio = JSON_UNQUOTE(JSON_EXTRACT(productos, CONCAT('$[', i, '].precio')));

            INSERT INTO detalle_pedido (pedido_id, producto, cantidad, precio_unitario)
            VALUES (pedidoId, produto, quantidade, precio);

            SET i = i + 1;
        END WHILE;

END //

DELIMITER ;
