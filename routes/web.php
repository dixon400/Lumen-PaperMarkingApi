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
    return 'Welcome To The Grading System'; 
});


//PaperType Route
$router->get('/papertypes', 'PaperTypeController@index');
$router->get('/papertypes/{id}', 'PaperTypeController@show');
$router->post('/papertypes', 'PaperTypeController@store');
$router->put('/papertypes/{id}', 'PaperTypeController@update');
$router->patch('/papertypes/{id}', 'PaperTypeController@update');
$router->delete('/papertypes/{id}', 'PaperTypeController@delete');


//Status Route
$router->get('/statuses', 'StatusController@index');
$router->get('/statuses/{id}', 'StatusController@show');
$router->post('/statuses', 'StatusController@store');
$router->put('/statuses/{id}', 'StatusController@update');
$router->patch('/statuses/{id}', 'StatusController@update');
$router->delete('/statuses/{id}', 'StatusController@delete');


//Subject Route
$router->get('/subjects', 'SubjectController@index');
$router->get('/subjects/{id}', 'SubjectController@show');
$router->post('/subjects', 'SubjectController@store');
$router->put('/subjects/{id}', 'SubjectController@update');
$router->patch('/subjects/{id}', 'SubjectController@update');
$router->delete('/subjects/{id}', 'SubjectController@delete');


//Paper Route
$router->get('/papers', 'PaperController@index');
$router->get('/papers/{id}', 'PaperController@show');
$router->post('/papers', 'PaperController@store');
$router->put('/papers/{id}', 'PaperController@update');
$router->patch('/papers/{id}', 'PaperController@update');
$router->delete('/papers/{id}', 'PaperController@delete');


//Answer
$router->get('/answers', 'AnswerController@index');
$router->get('/answers/{id}', 'AnswerController@show');
$router->post('/answers', 'AnswerController@store');
$router->put('/answers/{id}', 'AnswerController@update');
$router->patch('/answers/{id}', 'AnswerController@update');
$router->delete('/answers/{id}', 'AnswerController@delete');


//Student Route
$router->get('/students', 'StudentController@index');
$router->get('/students/{id}', 'StudentController@show');
$router->post('/students', 'StudentController@store');
$router->put('/students/{id}', 'StudentController@update');
$router->patch('/students/{id}', 'StudentController@update');
$router->delete('/students/{id}', 'StudentController@delete');


//Studentpaper Route
$router->get('/studentpapers', 'StudentPaperController@index');
$router->get('/studentpapers/{id}', 'StudentPaperController@show');
$router->post('/studentpapers', 'StudentPaperController@store');
$router->put('/studentpapers/{id}', 'StudentPaperController@update');
$router->patch('/studentpapers/{id}', 'StudentPaperController@update');
$router->delete('/studentpapers/{id}', 'StudentPaperController@delete');
$router->get('/studentpapers/markscript/{studentid}/{id}', 'StudentPaperController@markScript');
