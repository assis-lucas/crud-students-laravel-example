<?php

Route::middleware(['web'])
    ->name('courses.')
    ->prefix('courses')
    ->group(function () {
        Route::get("/", "App\Http\Controllers\CourseController@index")->name('index');
        Route::get("/create", "App\Http\Controllers\CourseController@create")->name('create');
        Route::post("/store", "App\Http\Controllers\CourseController@store")->name('store');
        Route::get("/show/{id}", "App\Http\Controllers\CourseController@show")->name('show');
        Route::patch("/update/{id}", "App\Http\Controllers\CourseController@update")->name('update');
        Route::get("/edit/{id}", "App\Http\Controllers\CourseController@edit")->name('edit');
        Route::patch("/{id}", "App\Http\Controllers\CourseController@destroy")->name('destroy');
    });
