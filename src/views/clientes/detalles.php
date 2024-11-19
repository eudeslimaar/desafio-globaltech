<?php include_once __DIR__ . '/../layouts/header.php'; ?>
    <div class="container">
    <h2>Detalles del Cliente</h2>

    <?php if (isset($cliente)): ?>
        <p>Nombre: <?= htmlspecialchars($cliente->getNombre()) ?></p>
        <p>Email: <?= htmlspecialchars($cliente->getEmail()) ?></p>
        <p>Fecha de Registro: <?= htmlspecialchars($cliente->getFechaRegistro()) ?></p>
        <a href="/clientes/<?= htmlspecialchars($cliente->getId()) ?>/editar">Editar Cliente</a>
        <a href="/pedidos/cliente/<?= htmlspecialchars($cliente->getId()) ?>">Pedidos</a>
        <a href="/pedidos/cliente/<?= htmlspecialchars($cliente->getId()) ?>/nuevo-pedido/">Nuevo Pedido</a>
    <?php else: ?>
        <p>Cliente no encontrado.</p>
    <?php endif; ?>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
