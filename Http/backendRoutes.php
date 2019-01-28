<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icommercelocaldelivery'], function (Router $router) {
    $router->bind('icommercelocaldelivery', function ($id) {
        return app('Modules\Icommercelocaldelivery\Repositories\IcommerceLocalDeliveryRepository')->find($id);
    });
    $router->get('icommercelocaldeliveries', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.index',
        'uses' => 'IcommerceLocalDeliveryController@index',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.index'
    ]);
    $router->get('icommercelocaldeliveries/create', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.create',
        'uses' => 'IcommerceLocalDeliveryController@create',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.create'
    ]);
    $router->post('icommercelocaldeliveries', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.store',
        'uses' => 'IcommerceLocalDeliveryController@store',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.create'
    ]);
    $router->get('icommercelocaldeliveries/{icommercelocaldelivery}/edit', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.edit',
        'uses' => 'IcommerceLocalDeliveryController@edit',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.edit'
    ]);
    $router->put('icommercelocaldeliveries/{icommercelocaldelivery}', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.update',
        'uses' => 'IcommerceLocalDeliveryController@update',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.edit'
    ]);
    $router->delete('icommercelocaldeliveries/{icommercelocaldelivery}', [
        'as' => 'admin.icommercelocaldelivery.icommercelocaldelivery.destroy',
        'uses' => 'IcommerceLocalDeliveryController@destroy',
        'middleware' => 'can:icommercelocaldelivery.icommercelocaldeliveries.destroy'
    ]);
// append

});
