<?php
$totalCantidad = $totalCantidad ?? 0;
$totalPrecio = $totalPrecio ?? 0;
?>
<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
<h2>Total de pedidos</h2>

<?php if (!empty($pedidos) && is_array($pedidos)): ?>

    <table id="tabela-pedidos">
        <thead>
        <tr>
            <th>ID Pedido</th>
            <th>Fecha Pedido</th>
            <th>Estado</th>
            <th>Actualizar estado</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?= htmlspecialchars($pedido->getId()); ?></td>
                <td><?= htmlspecialchars($pedido->getFechaPedido()); ?></td>
                <td><?= htmlspecialchars($pedido->getEstado()); ?></td>
                <?php if($pedido->getEstado() !== 'entregado'): ?>
                <td ><a href="/pedidos/<?php echo htmlspecialchars($pedido->getId()) ?>/editar">editar</a></td>
                <?php else: ?>
                <td > - </td>
                <?php endif; ?>
                <td><?= htmlspecialchars($pedido->getProducto()); ?></td>
                <td class="cantidad"><?= htmlspecialchars($pedido->getCantidad()); ?></td>
                <td class="precio"><?= htmlspecialchars(number_format($pedido->getPrecioUnitario(), 2)); ?></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php else: ?>
    <p>No hay pedidos.</p>
<?php endif; ?>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
