<?php
/**
 * This file contains all the routes for the project
 */

use App\Router;
use Pecee\Http\Request;
use App\Middlewares\CsrfVerifier;
use App\Handlers\CustomExceptionHandler;

Router::csrfVerifier(new CsrfVerifier());

Router::setDefaultNamespace('\App\Controllers');

Router::group(['exceptionHandler' => CustomExceptionHandler::class], function () {

	Router::get('/', 'HomeController@index')->setName('home');
    Router::post('/store', 'HomeController@store')->setName('store');

	Router::get('/login', 'AuthController@index')->setName('login');
    Router::post('/login', 'AuthController@loginPost')->setName('loginPost');
    Router::get('/register', 'AuthController@register')->setName('register');
    Router::post('/registerStore', 'AuthController@registerStore')->setName('registerStore');
	Router::get('/logout', 'AuthController@logout')->setName('logout');
    Router::get('/error', 'ErrorController@show')->setName('error');
    Router::error(function(Request $request, \Exception $exception) {
        switch($exception->getCode()) {
            case 404:
                response()->redirect(url('error'));
            case 403:
                response()->redirect(url('error'));
        }
    });
});