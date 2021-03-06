<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//auth jwt - get key
$router->post('auth/login', ['uses' => 'AuthController@authenticate']);

//testing
$router->group(['middleware' => ['jwt.auth']], function () use ($router) {

    /*main act*/

    //category
    $router->group(['prefix' => 'category'], function () use ($router) {
        $router->post('create', 'CategoryController@create');
        $router->get('read/{id}', 'CategoryController@read');
        $router->post('update/{id}', 'CategoryController@update');//might use put method
        $router->delete('delete/{id}', 'CategoryController@delete');
        $router->get('list', 'CategoryController@list');
    });

    //product
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->post('create', 'ProductController@create');
        $router->get('read/{id}', 'ProductController@read');
        $router->post('update/{id}', 'ProductController@update');//might use put method
        $router->delete('delete/{id}', 'ProductController@delete');
        $router->get('list', 'ProductController@list');
        $router->get('listByCategory/{category_id}', 'ProductController@listByCategory');
    });

    //orders
    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->post('create', 'OrderController@create');
    });

    //testing
    $router->post('test', function () {
        return response()->json('ok');
    });
}
);

