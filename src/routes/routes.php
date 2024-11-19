<?php
namespace routes;

use core\Router;
use controllers\ClienteController;
use controllers\PedidoController;
use controllers\DashboardController;

require_once __DIR__ . '/../../vendor/autoload.php';

$router = new Router();


// DASHBOARD
$router->get('',                                     [DashboardController::class, 'index']);


// CLIENTES
$router->get('clientes',                             [ClienteController::class, 'getAllClientes']);
$router->get('clientes/sin-pedidos',                 [ClienteController::class, 'clientesSinPedidos']);
$router->get('clientes/{id}',                        [ClienteController::class, 'getClienteById']);
$router->get('clientes/{id}/editar',                 [ClienteController::class, 'editCliente']);
$router->post('clientes/{id}/actualizar',            [ClienteController::class, 'updateCliente']);


// PEDIDOS
$router->get('pedidos',                              [PedidoController::class, 'obtenerTodosPedidos']);
$router->get('pedidos/cliente/{id}',                 [PedidoController::class, 'obtenerPedidosPorCliente']);
$router->get('pedidos/cliente/{id}/nuevo-pedido',    [PedidoController::class, 'createPedidoForm']);
$router->post('pedidos/cliente/{id}/nuevo-pedido',   [PedidoController::class, 'createPedido']);
$router->get('pedidos/recientes',                    [PedidoController::class, 'obtenerPedidosRecientes']);
$router->get('pedidos/{id}/editar',                  [PedidoController::class, 'editEstadoPedido']);
$router->post('pedidos/{id}/actualizar',             [PedidoController::class, 'actualizarEstadoPedido']);
$router->get('pedidos/upload',                       [PedidoController::class, 'showFormularioCargar']);
$router->post('pedidos/upload',                      [PedidoController::class, 'cargarPedidoConDetalles']);

return $router;
