<?php

use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LoginController;
//use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;

use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductVariantController;
use App\Models\CloudinaryModel;

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
Route::delete('/admin/deleteProduct', [ProductController::class, 'deleteProduct']);
Route::get('/admin/productVariants', [ProductVariantController::class, 'getAllProductVariants']);

Route::get('/getCategoriesByProductId', [ProductCategoryController::class, 'getCategoriesByProductId']);
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
Route::get('/categories/parent', [CategoryController::class, 'getParentCategories']);

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
Route::get('/blogs', [BlogController::class, 'getAllBlogs']);
Route::post('/add-blog', [BlogController::class, 'addBlog']);
Route::post('/update-blog', [BlogController::class, 'updateBlog']);
Route::put('/blog/change-status/{id}', [BlogController::class, 'changeBlog']);
Route::delete('/delete-blog/{id}', [BlogController::class, 'deleteBlog']);
Route::get('/get-authorname', [BlogController::class, 'getNameUserByIds']);

//Images
Route::post('/upload-images', function (Request $request) {

    // Gọi hàm uploadImage từ service hoặc trực tiếp
    $response = CloudinaryModel::uploadImage($request->file('images'));

    // Trả về kết quả
    return response()->json($response);
});
