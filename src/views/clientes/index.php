<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Lista de Clientes</h2>
        <?php if (isset($clientes) && is_array($clientes) && count($clientes) > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente->getId()) ?></td>
                        <td><?= htmlspecialchars($cliente->getNombre()) ?></td>
                        <td><?= htmlspecialchars($cliente->getEmail()) ?></td>
                        <td>
                            <a href="/clientes/<?= htmlspecialchars($cliente->getId()) ?>">Ver Detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No se encontraron clientes.</p>
        <?php endif; ?>
</div>
<!-- /.container -->
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
