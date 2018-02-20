<?php

/* Test */

$router->get('/', function () use ($router) {
    $res['success'] = true;
    $res['result'] = "Hello this is a good response!";
    return response($res);
});

/* Auth */

$router->post('/login', 'LoginController@index');

$router->post('/register', 'UserController@register');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@get_user']);
$router->put('/user/{id}','UserController@update');

/* Unit */

$router->put('/unit/{id}', 'UnitController@update');
$router->delete('/unit/{id}', 'UnitController@delete');
$router->post('unit', 'UnitController@store');
$router->get('unit','UnitController@index');
$router->get('unit/{id}','UnitController@show');

/* Pesanan */
$router->get('/pesanan', 'PesananController@index');

$router->post('/pesanan', 'PesananController@create');
//$router->get('/pesanan/{id}', 'PesananController@show');
$router->get('/pesanan/{user}', 'PesananController@byuser');
$router->get('/pesanan/{user}/{id}', 'PesananController@query');
$router->delete('/pesanan/{id}','PesananController@destroy');

// For test purpose
//$router->put('test/{id}', 'UnitController@update');
//$router->get('/invoice/test/{id}', 'InvoiceController@test');
$router->get('/invoice/{id}', 'InvoiceController@index');
$router->post('/invoice/{id}', 'InvoiceController@create');
//$router->get('/invoice/test', 'InvoiceController@test');
//$router->post('/invoice/{id}', 'InvoiceController@test');
