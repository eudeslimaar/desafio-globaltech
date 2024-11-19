<?php include_once __DIR__ . '/../layouts/header.php'; ?>
    <div class="container">
    <h2>Pedidos Recientes (últimos 30 días)</h2>

    <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php elseif (!empty($pedidos) && is_array($pedidos)): ?>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cliente ID</th>
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
                    <td><?= $pedido->getId(); ?></td>
                    <td><?= $pedido->getClienteId(); ?></td>
                    <td><?= $pedido->getFechaPedido(); ?></td>
                    <td><?= $pedido->getEstado(); ?></td>
                    <td><?= $pedido->getProducto(); ?></td>
                    <td><?= $pedido->getCantidad(); ?></td>
                    <td><?= $pedido->getPrecioUnitario(); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
