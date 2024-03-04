<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;


Router::get( '/', 'App\Controller\IndexController@index');

Router::post('/clientes/{id}/transacoes', [App\Controller\ClientsController::class, 'transactions']);
Router::get('/clientes/{id}/extrato', [App\Controller\ClientsController::class, 'extract']);


Router::get('/favicon.ico', fn() => null);
