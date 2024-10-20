<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LoginController;
//use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AuthController;
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

//login
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.post');

//register
// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
//LOGIN,REGISTER
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

//CRUD BLOG
Route::get('/blog/{id}', [BlogController::class, 'getBlogById']);
Route::post('/add-blog', [BlogController::class, 'addBlog']);
Route::post('/update-blog', [BlogController::class, 'updateBlog']);
Route::put('/blog/change-status/{id}', [BlogController::class, 'changeBlog']);
Route::delete('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
