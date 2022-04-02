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

Route::prefix('todo')->group(function () {
    Route::get('/', 'ToDoController@index');

    Route::get('/tasks', 'ToDoController@goToTasks')->name('tasksRoute');
    Route::post('/tasks', 'ToDoController@getTasks')->name('getTasksRoute');
    Route::get('/mytasks', 'ToDoController@goToMyTasks')->name('myTasksRoute');

    Route::post('/updateTask', 'ToDoController@updateTask')->name('updateTaskRoute');
    Route::post('/deleteTask', 'ToDoController@deleteTask')->name('deleteRoute');

    Route::post('/saveStatus', 'ToDoController@saveStatus');
});
