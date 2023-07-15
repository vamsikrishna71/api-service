<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SampleDataController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\JournalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// Sample API route
Route::get('/profits', [SampleDataController::class, 'profits'])->name('profits');

Route::post('/register', [RegisteredUserController::class, 'apiStore']);

Route::post('/login', [AuthenticatedSessionController::class, 'apiStore']);

Route::post('/forgot_password', [PasswordResetLinkController::class, 'apiStore']);

Route::post('/verify_token', [AuthenticatedSessionController::class, 'apiVerifyToken']);

Route::get('/users', [SampleDataController::class, 'getUsers']);
// Route::get('/quotes',[QuoteController::class,'getQuotes']);
// Route::middleware('auth:api')->group(function(){
    Route::prefix('v1')->group(function(){
        //Quotes
        Route::get('/quotes',[QuoteController::class,'getQuotes']);
        Route::get('/quotes/categories',[QuoteController::class,'getQuoteByNames']);
        Route::get('/quotes/{id}', [QuoteController::class,'getShowQuote']);
        Route::delete('/quotes/{id}', [QuoteController::class,'delete']);
        Route::get('/get-quotes',[QuoteController::class,'getOnlyQuotes']);
        Route::get('/get-quotes-month',[QuoteController::class,'getQuotesWithMonth']);
        Route::get('/get-quotes-day',[QuoteController::class,'getQuotesByDate']);

        //Categories
        Route::get('/categories',[CategoryController::class,'getCategory']);
        Route::get('/categories/{id}',[CategoryController::class,'getShowCategory']);
        Route::get('/get-categories/{id}',[CategoryController::class,'getShowSubcategoriesByCategory']);

        //Subcategories
        Route::get('/subcategories',[SubcategoryController::class,'getSubcategoriesByCategory']);
    });
// });
Route::post('/dates/{date}/content', [JournalController::class, 'store']);
Route::put('/dates/{date}/content/{id}', [JournalController::class, 'update']);
