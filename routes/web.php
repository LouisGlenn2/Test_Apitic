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

//route pour arriver sur index.php
Route::get('/', 'ControllerAnimaux@index');

//route pour accéder à index.php avec la liste des animaux
Route::get('/list', 'ControllerAnimaux@index')->name('list');

//route pour accéder à la fonction "suppresion" d'un animal
Route::get('/delete/{id}', 'ControllerAnimaux@delete')->name('delete');

//route pour accéder à la fonction ajouter un animal
Route::get('/add', 'ControllerAnimaux@create')->name('add');
Route::post('/add', 'ControllerAnimaux@store');

//route pour accéder à la fonction editer qui nous renvoie sur la page update.php
Route::get('/edit/{id}', 'ControllerAnimaux@edit')->name('edit');
//route pour accéder à la fonction editer qui permet d'envoyer la requete à la bdd
Route::get('/update/{id}', 'ControllerAnimaux@update')->name('update');

//route pour accéder à la fonction de tri des animaux par type
Route::get('/orderBy', 'ControllerAnimaux@orderByType')->name('orderBy');

?>