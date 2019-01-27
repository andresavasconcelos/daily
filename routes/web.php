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
header("access-control-allow-origin: https://pagseguro.uol.com.br");

//***SITE***
Route::get('/', 'SiteController@index');
Route::get('/sobre', 'SiteController@getSobre');
Route::get('/assinaturas/{code}', 'SiteController@getAssinaturas');
Route::post('/assinaturas/{code}', 'CheckoutController@checkoutPayment');
Route::get('/assinatura/confirmacao/{id}', 'CheckoutController@confirmarPagamento');
Route::get('/404', 'SiteController@getNaoEncontrado');
Route::post('/assinantes', 'SiteController@postAssinantes');
Route::get('/revistas', 'SiteController@getRevistas');
Route::post('/contato', 'SiteController@postContato');
Route::get('/assineja', 'SiteController@getAssineJa');
Route::get('/noticias', 'SiteController@getNoticias');
Route::get('/noticia/{alias}', 'SiteController@getNoticia');
Route::get('/noticia_empreendedorismo/{alias}', 'SiteController@getNoticiaEmp');
Route::get('/eventos', 'SiteController@getEventos');
Route::get('/evento/{alias}', 'SiteController@getEvento');
Route::get('/materias', 'SiteController@getMaterias');
Route::get('/materia/{alias}', 'SiteController@getMateria');

Route::post('/listenerPagseguro', "CheckoutController@listenerPagSeguro");
//***ADMIN***
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function (){

    Route::get('/painel', 'HomeController@index');
    Route::get('/assinantes', 'Admin\AssinantesController@index');
    Route::get('/assinantes/exportar', 'Admin\AssinantesController@exportListAssinantes');
    Route::get('/assinante/{id}', "Admin\AssinantesController@getAssinante");
    Route::post('/assinante/{id}/editar', "Admin\AssinantesController@postAssinante");
    Route::post('/assinante/{id}/editar', "Admin\AssinantesController@postAssinante");
    Route::post('/assinatura/{id}/editar', "Admin\AssinantesController@editarAssinatura");

    Route::get('/materias', 'Admin\MateriasController@index');
    Route::get('/materia/adicionar', 'Admin\MateriasController@create');
    Route::post('/materia/adicionar', 'Admin\MateriasController@store');

    Route::get('/noticias', 'Admin\NoticiasController@index');
    Route::get('/noticia/adicionar', 'Admin\NoticiasController@create');
    Route::post('/noticia/adicionar', 'Admin\NoticiasController@store');

    Route::get('/eventos', 'Admin\EventosController@index');
    Route::get('/evento/adicionar', 'Admin\EventosController@create');
    Route::post('/evento/adicionar', 'Admin\EventosController@store');

    Route::get('/bonus', 'Admin\BonusController@index');
    Route::get('/bonus/adicionar', 'Admin\BonusController@create');
    Route::post('/bonus/adicionar', 'Admin\BonusController@store');

    Route::get('/projetos', 'Admin\ProjetoController@index');
    Route::get('/projeto/adicionar', 'Admin\ProjetoController@create');
    Route::post('/projeto/adicionar', 'Admin\ProjetoController@store');

    Route::get('/funcionarios', 'Admin\FuncionarioController@index');
    Route::get('/funcionario/adicionar', 'Admin\FuncionarioController@create');
    Route::post('/funcionario/adicionar', 'Admin\FuncionarioController@store');

    Route::get('/dailies', 'Admin\DailyController@index');
    Route::get('/daily/adicionar', 'Admin\DailyController@create');
    Route::post('/daily/adicionar', 'Admin\DailyController@store');

    Route::get('/edicoes', 'Admin\EdicoesController@index');
    Route::get('/edicao/adicionar', 'Admin\EdicoesController@create');
    Route::post('/edicao/adicionar', 'Admin\EdicoesController@store');

    Route::get('/materia/editar/{id}', 'Admin\MateriasController@edit');
    Route::post('/materia/editar/{id}', 'Admin\MateriasController@update');

    Route::get('/noticia/editar/{id}', 'Admin\NoticiasController@edit');
    Route::post('/noticia/editar/{id}', 'Admin\NoticiasController@update');

    Route::get('/evento/editar/{id}', 'Admin\EventosController@edit');
    Route::post('/evento/editar/{id}', 'Admin\EventosController@update');

    Route::get('/bonus/editar/{id}', 'Admin\BonusController@edit');
    Route::post('/bonus/editar/{id}', 'Admin\BonusController@update');

    Route::get('/edicao/editar/{id}', 'Admin\EdicoesController@edit');
    Route::post('/edicao/editar/{id}', 'Admin\EdicoesController@update');

    Route::get('/projeto/editar/{id}', 'Admin\ProjetoController@edit');
    Route::post('/projeto/editar/{id}', 'Admin\ProjetoController@update');

    Route::get('/funcionario/editar/{id}', 'Admin\FuncionarioController@edit');
    Route::post('/funcionario/editar/{id}', 'Admin\FuncionarioController@update');

    Route::get('/daily/editar/{id}', 'Admin\DailyController@edit');
    Route::post('/daily/editar/{id}', 'Admin\DailyController@update');

});

Auth::routes();
