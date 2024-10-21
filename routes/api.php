<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Crypt;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
Route::post('/admin/addProduct',[ProductController::class,'addProduct']);
Route::post('/admin/editProduct',[ProductController::class,'editProduct']);
Route::get('/getProductDetails', [ProductController::class, 'getProductDetails']);

// category manage
Route::get('/categories', [CategoryController::class, 'getCategoriesByPage']);

Route::get('/encrypt/{id}', function($id) {
    $encryptedId = Crypt::encrypt($id);
    return response()->json([
        'original_id' => $id,
        'encrypted_id' => $encryptedId,
    ]);
});
Route::get('/category/{id}', [CategoryController::class, 'getCategoryById']);
Route::post('/add-category', [CategoryController::class, 'addCategory']);
Route::post('/update-category', [CategoryController::class, 'updateCategory']);
Route::put('/category/change-status/{id}', [CategoryController::class, 'changeCategory']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

