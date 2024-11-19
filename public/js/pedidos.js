$(document).ready(function () {
    $('#btn-guardar-pedido').on('click', function () {
        const clienteId = $('#cliente-id').val();
        const fechaPedido = $('#fecha_pedido').val();
        const estado = $('#estado').val();
        const productos = [];

        $('.detalle-pedido').each(function () {
            const producto = $(this).find('input[name="producto[]"]').val();
            const cantidad = $(this).find('input[name="cantidad[]"]').val();
            const precio = $(this).find('input[name="precio[]"]').val();

            if (producto && cantidad && precio) {
                productos.push({ producto, cantidad, precio });
            }
        });

        if (!clienteId || !fechaPedido || !estado || productos.length === 0) {
            alert('Por favor, complete todos los campos.');
            return;
        }

        $.ajax({
            url: `/pedidos/cliente/${clienteId}/nuevo`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                fecha_pedido: fechaPedido,
                estado: estado,
                productos: productos
            }),
            success: function (response) {
                alert(response.message);
                if (response.status === 'success') {
                    window.location.href = `/pedidos/cliente/${clienteId}`;
                }
            },
            error: function () {
                alert('Error al guardar el pedido.');
            }
        });
    });

    $('#btn-agregar-detalle').on('click', function () {
        $('#detalle-pedido-container').append(`
            <div class="detalle-pedido">
                <label>Producto:</label>
                <input type="text" name="producto[]" required>
                <label>Cantidad:</label>
                <input type="number" name="cantidad[]" required>
                <label>Precio Unitario:</label>
                <input type="number" name="precio[]" step="0.01" required>
                <button type="button" class="btn-eliminar-detalle">Eliminar</button>
            </div>
        `);
    });

    $(document).on('click', '.btn-eliminar-detalle', function () {
        $(this).closest('.detalle-pedido').remove();
    });
});
