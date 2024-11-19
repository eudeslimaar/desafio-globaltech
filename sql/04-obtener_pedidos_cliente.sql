USE gestion_pedidos_EUDES_LIMA;

DELIMITER //

CREATE PROCEDURE obtener_pedidos_cliente(IN clienteId INT)
BEGIN
    SELECT
        p.id AS pedido_id,
        p.fecha_pedido,
        p.estado,
        dp.producto,
        dp.cantidad,
        dp.precio_unitario
    FROM pedidos p
             INNER JOIN detalle_pedido dp ON p.id = dp.pedido_id
    WHERE p.cliente_id = clienteId;
END //

DELIMITER ;
