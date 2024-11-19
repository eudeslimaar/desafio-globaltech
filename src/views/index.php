<?php include_once __DIR__ . '/layouts/header.php'; ?>
<div class="container">
    <h1>Dashboard - Indicadores Principales</h1>
    <div id="dashboard">
        <div class="card">
            <h3>Total de Clientes</h3>
            <p id="total-clientes"><?= htmlspecialchars($data['totalClientes']); ?></p>
        </div>
        <div class="card">
            <h3>Total de Pedidos</h3>
            <p id="total-pedidos"><?= htmlspecialchars($data['totalPedidos']); ?></p>
        </div>
        <div class="card">
            <h3>Total de Detalles</h3>
            <p id="total-detalles"><?= htmlspecialchars($data['totalDetalles']) ; ?></p>
        </div>
        <div class="card">
            <h3>Pedidos por Estado</h3>
            <ul id="estado-pedidos">
                <?php foreach ($data['estadoPedidos'] as $estado): ?>
                    <li><?= htmlspecialchars(ucfirst($estado['estado']) . ': ' . $estado['total']); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/public/js/dashboard.js"></script>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>
