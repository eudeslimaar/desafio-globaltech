<?php include_once __DIR__ . '/../layouts/header.php'; ?>
    <div class="container">
        <h2>Detalhes dos Pedidos</h2>
        <?php if (!empty($pedidos) && is_array($pedidos)): ?>
            <table>
                <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>ID Cliente</th>
                    <th>Fecha Pedido</th>
                    <th>Estado</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido->getId()); ?></td>
                        <td><?= htmlspecialchars($pedido->getClienteId()); ?></td>
                        <td><?= htmlspecialchars($pedido->getFechaPedido()); ?></td>
                        <td><?= htmlspecialchars($pedido->getEstado()); ?></td>
                        <td><?= htmlspecialchars($pedido->getProducto()); ?></td>
                        <td><?= htmlspecialchars($pedido->getCantidad()); ?></td>
                        <td><?= htmlspecialchars(number_format($pedido->getPrecioUnitario(), 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron pedidos.</p>
        <?php endif; ?>
    </div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>