USE gestion_pedidos_EUDES_LIMA;

DELIMITER //

CREATE PROCEDURE InsertarDatosIniciales()
BEGIN
    DECLARE i INT DEFAULT 1;

    WHILE i <= 20 DO
        INSERT INTO clientes (nombre, email, fecha_registro)
        VALUES
            (CONCAT('cliente', i),
            CONCAT('cliente', i, '@', ELT(FLOOR(1 + (RAND() * 3)), 'gmail.com', 'live.com', 'outlook.com')),
            DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 365) DAY));
        SET i = i + 1;
    END WHILE;

    SET i = 1;

    WHILE i <= 10000 DO
        INSERT INTO pedidos (cliente_id, fecha_pedido, estado)
        VALUES
            (FLOOR(1 + RAND() * 20), DATE_SUB(CURDATE(), INTERVAL FLOOR(RAND() * 365) DAY), IF(RAND() > 0.5, 'completado', 'pendiente'));
        SET i = i + 1;
    END WHILE;

    SET i = 1;

    WHILE i <= 10000 DO
        INSERT INTO detalle_pedido (pedido_id, producto, cantidad, precio_unitario)
        VALUES
            (i, CONCAT('Producto ', FLOOR(1 + RAND() * 100)), FLOOR(1 + RAND() * 10), ROUND(RAND() * 100, 2));
        SET i = i + 1;
    END WHILE;

END //

DELIMITER ;

CALL InsertarDatosIniciales();
