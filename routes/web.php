<?php

ini_set('memory_limit', '128M');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//***ADMIN***
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function (){


    Route::get('/painel', 'HomeController@index');

    Route::get('/projetos', 'Admin\ProjetoController@index');
    Route::get('/projeto/adicionar', 'Admin\ProjetoController@create');
    Route::post('/projeto/adicionar', 'Admin\ProjetoController@store');

    Route::get('/funcionarios', 'Admin\FuncionarioController@index');
    Route::get('/funcionario/adicionar', 'Admin\FuncionarioController@create');
    Route::post('/funcionario/adicionar', 'Admin\FuncionarioController@store');

    Route::get('/dailies', 'Admin\DailyController@index');
    Route::get('/daily/adicionar', 'Admin\DailyController@create');
    Route::post('/daily/adicionar', 'Admin\DailyController@store');

    Route::get('/projeto/editar/{id}', 'Admin\ProjetoController@edit');
    Route::post('/projeto/editar/{id}', 'Admin\ProjetoController@update');

    Route::get('/funcionario/editar/{id}', 'Admin\FuncionarioController@edit');
    Route::post('/funcionario/editar/{id}', 'Admin\FuncionarioController@update');

    Route::get('/daily/editar/{id}', 'Admin\DailyController@edit');
    Route::post('/daily/editar/{id}', 'Admin\DailyController@update');


//    Route::get('/register', function(){
//        return redirect('404');
});

Auth::routes();

