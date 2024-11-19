$(document).ready(function () {
    function loadDashboard() {
        $.ajax({
            url: '/',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#total-clientes').text(data.totalClientes);
                $('#total-pedidos').text(data.totalPedidos);
                $('#total-detalles').text(data.totalDetalles);

                let estadoPedidos = '';
                data.estadoPedidos.forEach(estado => {
                    estadoPedidos += `<li>${estado.estado.charAt(0).toUpperCase() + estado.estado.slice(1)}: ${estado.total}</li>`;
                });
                $('#estado-pedidos').html(estadoPedidos);
            }
        });
    }

    loadDashboard();
});
