<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Agregar Pedido para <?= htmlspecialchars($cliente->getNombre()); ?></h2>

    <form id="form-nuevo-pedido">
        <input type="hidden" id="cliente-id" value="<?= htmlspecialchars($cliente->getId()); ?>">

        <div>
            <label for="fecha_pedido">Fecha del Pedido:</label>
            <input type="date" id="fecha_pedido" name="fecha_pedido" required>
        </div>
        <div>
            <label for="estado">Estado del Pedido:</label>
            <select id="estado" name="estado">
                <option value="pendiente">Pendiente</option>
                <option value="enviado">Enviado</option>
                <option value="entregado">Entregado</option>
            </select>
        </div>

        <h3>Detalles del Pedido</h3>
        <div id="detalle-pedido-container">
            <div class="detalle-pedido">
                <label>Producto:</label>
                <input type="text" name="producto[]" required>
                <label>Cantidad:</label>
                <input type="number" name="cantidad[]" required>
                <label>Precio Unitario:</label>
                <input type="number" name="precio[]" step="0.01" required>
            </div>
        </div>
        <button type="button" id="btn-agregar-detalle">Agregar Producto</button>
        <button type="button" id="btn-guardar-pedido">Guardar Pedido</button>
    </form>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
