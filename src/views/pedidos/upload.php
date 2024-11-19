<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Subir Archivo de Pedidos</h2>
    <div id="drop-area">
        <form class="my-form">
            <p>Arrastra y suelta un archivo CSV o Excel aquí</p>
            <input type="file" id="fileElem" accept=".csv, .xlsx" onchange="handleFiles(this.files)">
            <label class="button" for="fileElem">Seleccionar archivo</label>
            <button type="button" onclick="uploadFile()">Enviar Arquivo</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/public/js/upload.js"></script>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
