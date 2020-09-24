<?php

Route::middleware(['web'])
    ->name('students.')
    ->prefix('students')
    ->group(function () {
        Route::get("/", "App\Http\Controllers\StudentController@index")->name('index');
        Route::get("/create", "App\Http\Controllers\StudentController@create")->name('create');
        Route::post("/", "App\Http\Controllers\StudentController@store")->name('store');
        Route::get("/show/{id}", "App\Http\Controllers\StudentController@show")->name('show');
        Route::patch("/update/{id}", "App\Http\Controllers\StudentController@update")->name('update');
        Route::get("/edit/{id}", "App\Http\Controllers\StudentController@edit")->name('edit');
        Route::patch("/{id}", "App\Http\Controllers\StudentController@destroy")->name('destroy');
    });
