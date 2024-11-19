<?php include_once __DIR__ . '/../layouts/header.php'; ?>
<div class="container">
    <h2>Atualizar Estado do Pedido</h2>
    <form id="form-atualizar-estado">
        <div>
            <label for="pedido-id">ID do Pedido:</label>
            <input type="number" id="pedido-id" name="pedidoId" value="<?= $pedido->getId(); ?>" readonly>
        </div>
        <div>
            <label for="estado">Novo Estado:</label>
            <select id="estado" name="estado">
                <option value="pendiente" <?= $pedido->getEstado() === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="enviado" <?= $pedido->getEstado() === 'enviado' ? 'selected' : ''; ?>>Enviado</option>
                <option value="entregado" <?= $pedido->getEstado() === 'entregado' ? 'selected' : ''; ?>>Entregado</option>
            </select>
        </div>
        <button type="button" id="btn-actualizar-estado">Atualizar Estado</button>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/public/js/pedido.js"></script>
</div>
<?php include_once __DIR__ . '/../layouts/footer.php'; ?>
