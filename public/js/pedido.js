$(document).ready(function () {
    $('#btn-actualizar-estado').on('click', function () {
        const pedidoId = $('#pedido-id').val();
        const estado = $('#estado').val();
        console.log(`Pedido ID: ${pedidoId}, Estado: ${estado}`);

        if (!pedidoId || !estado) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        $.ajax({
            url: `/pedidos/${pedidoId}/actualizar`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ pedidoId: pedidoId, estado: estado }),
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('¡Estado del pedido actualizado con éxito!');
                    location.reload();
                } else {
                    alert(`Error: ${response.message}`);
                }
            },
            error: function () {
                alert('Error al enviar la solicitud. Inténtalo de nuevo más tarde.');
            }
        });
    });
});
