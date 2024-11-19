USE gestion_pedidos_EUDES_LIMA;

DELIMITER //

CREATE PROCEDURE actualizar_estado_pedido(
    IN pedidoId INT,
    IN nuevoEstado VARCHAR(20)
)
BEGIN
    UPDATE pedidos
    SET estado = nuevoEstado
    WHERE id = pedidoId;
END //

DELIMITER ;
