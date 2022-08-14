<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\API\RoleController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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




Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum','isAPIAdmin'])->group(function(){

    Route::get('/checkingAuthenticated', function() {
        return response()->json(['message'=>'You are in', 'status'=>200], 200);
    });
    //Role
    Route::get('view-role', [RoleController::class, 'index']);
    Route::post('store-role', [RoleController::class, 'store']);
    Route::get('edit-role/{id}', [RoleController::class, 'edit']);
    Route::put('update-role/{id}', [RoleController::class, 'update']);
    Route::delete('delete-role/{id}', [RoleController::class, 'destroy']);

    //Category
    Route::get('view-category', [CategoryController::class, 'index']);
    Route::post('store-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('all-category', [CategoryController::class, 'allcategory']);

    //Products
    Route::post('store-product', [ProductController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->group(function(){

    Route::post('logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
