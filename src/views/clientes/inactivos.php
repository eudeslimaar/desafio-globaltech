<?php include_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">
    <h2>Clientes sin Pedidos</h2>

    <?php if (isset($clientes['message'])): ?>
        <p><?= htmlspecialchars($clientes['message']); ?></p>
    <?php elseif (!empty($clientes) && is_array($clientes)): ?>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= htmlspecialchars($cliente->getId()); ?></td>
                    <td><?= htmlspecialchars($cliente->getNombre()); ?></td>
                    <td><?= htmlspecialchars($cliente->getEmail()); ?></td>
                    <td><?= htmlspecialchars($cliente->getFechaRegistro()); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
