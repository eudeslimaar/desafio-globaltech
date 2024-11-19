
<div class="container">
    <h2>Clientes Sin Pedidos</h2>
    <table class="table">
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
                    <td><?= htmlspecialchars($cliente->getId()) ?></td>
                    <td><?= htmlspecialchars($cliente->getNombre()) ?></td>
                    <td><?= htmlspecialchars($cliente->getEmail()) ?></td>
                    <td><?= htmlspecialchars($cliente->getFechaRegistro()) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
