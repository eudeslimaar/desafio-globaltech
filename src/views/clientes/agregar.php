<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Agregar Pedido</h2>

    <form action="/pedidos/agregar" method="post">
        <label for="clienteId">ID del Cliente:</label>
        <input type="number" name="clienteId" id="clienteId" required>
        <label for="producto">Producto:</label>
        <input type="text" name="producto" id="producto" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <button type="submit">Agregar Pedido</button>
    </form>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
