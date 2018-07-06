<?php

Route::prefix('posts')->group(function () {
    Route::get('/', 'Posts@index');
    Route::get('{post}', 'Posts@fetch');
    Route::post('/', 'Posts@create');
    Route::put('{post}', 'Posts@update');
    Route::delete('{post}', 'Posts@delete');
    Route::post('{post}/comment', 'Posts@comment');
});

Route::prefix('pages')->group(function () {
    Route::get('/', 'Pages@index');
    Route::get('{page}', 'Pages@fetch');
    Route::post('/', 'Pages@create');
    Route::put('{page}', 'Pages@update');
    Route::delete('{page}', 'Pages@delete');
});
