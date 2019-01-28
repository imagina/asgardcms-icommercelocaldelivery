<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'icommercelocaldelivery'], function (Router $router) {
    
    $router->get('/', [
        'as' => 'icommercelocaldelivery.api.localdelivery.init',
        'uses' => 'IcommerceLocaldeliveryApiController@init',
    ]);

   

});