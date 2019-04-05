<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->group(['prefix' => 'itourism'], function (Router $router) {

    $router->get('/', [
        'as' => 'itourism.plans.index',
        'uses' => 'PublicController@index',
    ]);

    $router->get('/{slug}', [
        'as' => 'itourism.plans.show',
        'uses' => 'PublicController@show',
    ]);

});
