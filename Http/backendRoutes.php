<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icommercelocaldelivery'], function (Router $router) {
    $router->bind('configlocaldelivery', function ($id) {
        return app('Modules\IcommerceLocaldelivery\Repositories\ConfiglocaldeliveryRepository')->find($id);
    });
    $router->post('configlocaldeliveries', [
        'as' => 'admin.icommercelocaldelivery.configlocaldelivery.store',
        'uses' => 'ConfiglocaldeliveryController@store',
        'middleware' => 'can:icommercelocaldelivery.configlocaldeliveries.create'
    ]);
   
    $router->put('configlocaldeliveries/', [
        'as' => 'admin.icommercelocaldelivery.configlocaldelivery.update',
        'uses' => 'ConfiglocaldeliveryController@update',
        'middleware' => 'can:icommercelocaldelivery.configlocaldeliveries.edit'
    ]);
    
// append

});
