let selectedFile;

function handleFiles(files) {
    selectedFile = files[0];
}

function uploadFile() {
    if (!selectedFile) {
        alert('Por favor, seleccione un archivo primero.');
        return;
    }

    const formData = new FormData();
    formData.append('file', selectedFile);

    $.ajax({
        url: '/pedidos/upload',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            alert('Archivo subido con éxito.');
        },
        error: function () {
            alert('Error al subir el archivo.');
        }
    });
}
