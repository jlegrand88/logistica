<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ingresar_oc', 'OrdenCompraController@ingresarOrdenCompra')->name('ingresar_oc');
Route::get('/load_grilla_oc', 'OrdenCompraController@loadGrillaOrdenCompra')->name('load_grilla_oc');
Route::get('/grilla_oc', 'OrdenCompraController@grillaOrdenCompra')->name('grilla_oc');
Route::post('/procesar_oc', 'OrdenCompraController@procesarOrdenCompra')->name('procesar_oc');
Route::get('/download_pdf_oc', 'OrdenCompraController@downloadPDFOC')->name('download_pdf_oc');