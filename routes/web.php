<?php

/** @var Laravel\Lumen\Routing\Router $router */
$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['namespace' => 'Api', 'prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'bet'], function () use ($router) {
        $router->post('/', ['uses' => 'BetController']);
    });
});
