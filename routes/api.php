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
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\SizeController;
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

// PRODUCT
Route::get('/checkProduct', [ProductController::class, 'checkProduct']);
Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::get('/products-category/{id}', [ProductController::class, 'getProductByCategoryId']);
Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
Route::post('/admin/addProduct',[ProductController::class,'addProduct']);
Route::post('/admin/editProduct',[ProductController::class,'editProduct']);
Route::get('/getProductDetails', [ProductController::class, 'getProductDetails']);
Route::delete('/admin/deleteProduct', [ProductController::class, 'deleteProduct']);
Route::get('/admin/productVariants', [ProductVariantController::class, 'getAllProductVariants']);
Route::get('/getCategoriesByProductId', [ProductCategoryController::class, 'getCategoriesByProductId']);

// PRODUCT VARIANT
Route::get('/getAllSizes',[SizeController::class, 'getAllSizes']);
Route::get('/getAllColors',[ColorController::class, 'getAllColors']);
Route::post('/admin/addProductVariant',[ProductVariantController::class,'addProductVariant']);
Route::delete('/admin/deleteProductVariant', [ProductVariantController::class, 'deleteProductVariant']);
Route::post('/admin/editProductVariant',[ProductVariantController::class,'editProductVariant']);
Route::get('/getVariantByVariantId',[ProductVariantController::class, 'getVariantByVariantId']);
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
Route::delete('/delete-category/{id}', [CategoryController::class, 'changeCategory']);
Route::get('/categories/parent', [CategoryController::class, 'getParentCategories']);
Route::post('/category/check-assets', [CategoryController::class, 'checkCategoryAssets']);
Route::get('/category-childs/{id}', [CategoryController::class, 'getCategoryByParentId']);
Route::post('/update-product-category-and-parent', [CategoryController::class, 'updateProductCategoryAndParent']);

//login
// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.post');

//register
// Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
// Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
//LOGIN,REGISTER
//Reset password
Route::post('/reset', [AuthController::class, 'reset']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

//CRUD BLOG
Route::get('/blog/{id}', [BlogController::class, 'getBlogById']);
Route::get('/blogs', [BlogController::class, 'getAllBlogs']);
Route::get('/user-blogs', [BlogController::class, 'getBlogsByUserPage']);
Route::post('/add-blog', [BlogController::class, 'addBlog']);
Route::get('/authors-count-blog', [BlogController::class, 'getAuthorsWithCountBlog']);
Route::post('/update-blog', [BlogController::class, 'updateBlog']);
Route::put('/blog/change-status/{id}', [BlogController::class, 'changeBlog']);
Route::delete('/delete-blog/{id}', [BlogController::class, 'changeBlogStatus']);
Route::get('/get-authorname', [BlogController::class, 'getNameUserByIds']);
Route::get('/get-blog-by-author/{id}', [BlogController::class, 'getBlogsByAuthorId']);

// sửa profile
Route::middleware('auth:sanctum')->put('/profile', [ProfileController::class, 'update']);

// //Images
Route::post('/delete-image', function (Request $request) {

    $public_id = $request->public_id;
    // Gọi hàm uploadImage từ service hoặc trực tiếp
    $response = CloudinaryModel::deleteImage($public_id);

    // Trả về kết quả
    return response()->json($response);
});
// track users
Route::get('/top-products', [ProductController::class, 'getTopProducts']);
// sản phẩm có thể biết
Route::get('/top-products/{userId}', [ProductController::class, 'getTopProductsByUser']);
// sản phẩm đề xuất qua tracking
Route::get('/user-top-products/{userId}', [ProductController::class, 'getTopProductsByUserInteracted']);
//đề xuất sản phẩm tương tự
Route::get('/products/similar/{id}', [ProductController::class, 'getProductsBySimilarNameAndCategory']);
