<?php

use Faker\Factory;
use Laravel\Lumen\Routing\Router;

/** @var Router $router */
$router->get('/version', function () use ($router) {
    $composer = json_decode(
        file_get_contents(base_path('composer.json')),
        true,
        512,
        JSON_THROW_ON_ERROR);
    $version = $composer['version'];
    return response()->json(['version' => $version]);
});


/** @var Router $router */
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group(['prefix' => 'payment'], function () use ($router) {
        $router->get('/', 'PaymentController@get');
        $router->post('/', 'PaymentController@handler');
    });

    $router->get('/user', function () use ($router) {
        return $router->app->version() . ' Users API';
    });

    $router->post('/mp/webhook', 'WebhookController@handler');
});

$router->group(['prefix' => 'fake'], function () use ($router) {
    $router->get('/email', function () use ($router) {
        return response()->json(['email' => Factory::create()->email]);
    });
});

