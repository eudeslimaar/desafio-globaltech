<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Detalhes dos Pedidos</h2>
    <table>
        <thead>
        <tr>
            <th>Pedido ID</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($detallesPedidos as $detalle): ?>
            <tr>
                <td><?= htmlspecialchars($detalle['pedido_id']) ?></td>
                <td><?= htmlspecialchars($detalle['producto']) ?></td>
                <td><?= htmlspecialchars($detalle['cantidad']) ?></td>
                <td><?= htmlspecialchars($detalle['precio_unitario']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>