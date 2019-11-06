<?php
/** @var  Illuminate\Support\Facades\Route $router*/

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->group(['prefix' => 'pizza'], function () use ($router) {
        $router->get('/all', 'PizzaController@index');
        $router->get('/show/{id}', 'PizzaController@show');
        $router->post('/save', 'PizzaController@save');
        $router->put('/update/{id}', 'PizzaController@update');
        $router->delete('/delete/{id}', 'PizzaController@delete');
    });

    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get('/all', 'OrderController@index');
        $router->get('/show/{id}', 'OrderController@show');
        $router->post('/save', 'OrderController@save');
        $router->put('/finalized', 'OrderController@finalizedOrder');
        $router->delete('/cancel/{id}', 'OrderController@cancel');
    });
});
