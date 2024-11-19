<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <div class="container">
    <h2>Editar Cliente</h2>
    <form id="form-editar-cliente">
        <input type="hidden" id="cliente-id" value="<?= htmlspecialchars($cliente->getId()); ?>">
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cliente->getNombre()); ?>">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente->getEmail()); ?>">
        </div>
        <button type="button" id="btn-actualizar">Actualizar</button>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/public/js/cliente.js"></script>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>


