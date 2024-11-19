$(document).ready(function () {

    $('#btn-actualizar').on('click', function () {

        const clienteId = Number($('#cliente-id').val());
        const nombre = $('#nombre').val();
        const email = $('#email').val();

        console.log(clienteId)

        if (nombre.trim() === '' || email.trim() === '') {
            alert('Por favor, complete todos los campos.');
            return;
        }

        $.ajax({
            url: `/clientes/${clienteId}/actualizar`,
            type: 'POST',
            data: {
                nombre: nombre,
                email: email
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('¡Cliente actualizado con éxito!');

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
