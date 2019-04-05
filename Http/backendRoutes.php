<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/itourism'], function (Router $router) {
    $router->bind('plan', function ($id) {
        return app('Modules\Itourism\Repositories\PlanRepository')->find($id);
    });
    $router->get('plans', [
        'as' => 'admin.itourism.plan.index',
        'uses' => 'PlanController@index',
        'middleware' => 'can:itourism.plans.index'
    ]);
    $router->get('plans/create', [
        'as' => 'admin.itourism.plan.create',
        'uses' => 'PlanController@create',
        'middleware' => 'can:itourism.plans.create'
    ]);
    $router->post('plans', [
        'as' => 'admin.itourism.plan.store',
        'uses' => 'PlanController@store',
        'middleware' => 'can:itourism.plans.create'
    ]);
    $router->get('plans/{plan}/edit', [
        'as' => 'admin.itourism.plan.edit',
        'uses' => 'PlanController@edit',
        'middleware' => 'can:itourism.plans.edit'
    ]);
    $router->put('plans/{plan}', [
        'as' => 'admin.itourism.plan.update',
        'uses' => 'PlanController@update',
        'middleware' => 'can:itourism.plans.edit'
    ]);
    $router->delete('plans/{plan}', [
        'as' => 'admin.itourism.plan.destroy',
        'uses' => 'PlanController@destroy',
        'middleware' => 'can:itourism.plans.destroy'
    ]);
    $router->post('plan/upload/image', [
        'as' => 'itourism.gallery.upload',
        'uses' => 'PlanController@uploadGalleryimage',
    ]);

    $router->post('plan/delete/img', [
        'as' => 'itourism.gallery.delete',
        'uses' => 'PlanController@deleteGalleryimage',
    ]);
    $router->bind('persontypes', function ($id) {
        return app('Modules\Itourism\Repositories\PersonTypesRepository')->find($id);
    });
    $router->get('persontypes', [
        'as' => 'admin.itourism.persontypes.index',
        'uses' => 'PersonTypesController@index',
        'middleware' => 'can:itourism.persontypes.index'
    ]);
    $router->get('persontypes/create', [
        'as' => 'admin.itourism.persontypes.create',
        'uses' => 'PersonTypesController@create',
        'middleware' => 'can:itourism.persontypes.create'
    ]);
    $router->post('persontypes', [
        'as' => 'admin.itourism.persontypes.store',
        'uses' => 'PersonTypesController@store',
        'middleware' => 'can:itourism.persontypes.create'
    ]);
    $router->get('persontypes/{persontypes}/edit', [
        'as' => 'admin.itourism.persontypes.edit',
        'uses' => 'PersonTypesController@edit',
        'middleware' => 'can:itourism.persontypes.edit'
    ]);
    $router->put('persontypes/{persontypes}', [
        'as' => 'admin.itourism.persontypes.update',
        'uses' => 'PersonTypesController@update',
        'middleware' => 'can:itourism.persontypes.edit'
    ]);
    $router->delete('persontypes/{persontypes}', [
        'as' => 'admin.itourism.persontypes.destroy',
        'uses' => 'PersonTypesController@destroy',
        'middleware' => 'can:itourism.persontypes.destroy'
    ]);
    $router->bind('roomtypes', function ($id) {
        return app('Modules\Itourism\Repositories\RoomTypesRepository')->find($id);
    });
    $router->get('roomtypes', [
        'as' => 'admin.itourism.roomtypes.index',
        'uses' => 'RoomTypesController@index',
        'middleware' => 'can:itourism.roomtypes.index'
    ]);
    $router->get('roomtypes/create', [
        'as' => 'admin.itourism.roomtypes.create',
        'uses' => 'RoomTypesController@create',
        'middleware' => 'can:itourism.roomtypes.create'
    ]);
    $router->post('roomtypes', [
        'as' => 'admin.itourism.roomtypes.store',
        'uses' => 'RoomTypesController@store',
        'middleware' => 'can:itourism.roomtypes.create'
    ]);
    $router->get('roomtypes/{roomtypes}/edit', [
        'as' => 'admin.itourism.roomtypes.edit',
        'uses' => 'RoomTypesController@edit',
        'middleware' => 'can:itourism.roomtypes.edit'
    ]);
    $router->put('roomtypes/{roomtypes}', [
        'as' => 'admin.itourism.roomtypes.update',
        'uses' => 'RoomTypesController@update',
        'middleware' => 'can:itourism.roomtypes.edit'
    ]);
    $router->delete('roomtypes/{roomtypes}', [
        'as' => 'admin.itourism.roomtypes.destroy',
        'uses' => 'RoomTypesController@destroy',
        'middleware' => 'can:itourism.roomtypes.destroy'
    ]);
    $router->bind('planprice', function ($id) {
        return app('Modules\Itourism\Repositories\PlanPriceRepository')->find($id);
    });
    $router->get('planprices', [
        'as' => 'admin.itourism.planprice.index',
        'uses' => 'PlanPriceController@index',
        'middleware' => 'can:itourism.planprices.index'
    ]);
    $router->get('planprices/create', [
        'as' => 'admin.itourism.planprice.create',
        'uses' => 'PlanPriceController@create',
        'middleware' => 'can:itourism.planprices.create'
    ]);
    $router->post('planprices', [
        'as' => 'admin.itourism.planprice.store',
        'uses' => 'PlanPriceController@store',
        'middleware' => 'can:itourism.planprices.create'
    ]);
    $router->get('planprices/{planprice}/edit', [
        'as' => 'admin.itourism.planprice.edit',
        'uses' => 'PlanPriceController@edit',
        'middleware' => 'can:itourism.planprices.edit'
    ]);
    $router->put('planprices/{planprice}', [
        'as' => 'admin.itourism.planprice.update',
        'uses' => 'PlanPriceController@update',
        'middleware' => 'can:itourism.planprices.edit'
    ]);
    $router->delete('planprices/{planprice}', [
        'as' => 'admin.itourism.planprice.destroy',
        'uses' => 'PlanPriceController@destroy',
        'middleware' => 'can:itourism.planprices.destroy'
    ]);
// append




});
