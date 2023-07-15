<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;


Route::resource('users', UsersController::class);
Route::resource('quote',QuoteController::class);
Route::get('/quote/view',function(){
    dd('routes working');
})->name('quote.view');
Route::post('/quote/import',QuoteController::class,'import')->name('quote.import');
Route::resource('category', CategoryController::class);
Route::resource('subcategory', SubcategoryController::class);
