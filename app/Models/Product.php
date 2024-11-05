<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(SizeModel::class);
    }

    public function color()
    {
        return $this->belongsTo(ColorModel::class);
    }
    public static function checkProduct($request)
    {
        $id = $request->input('id');
        $decodedId = EncryptionModel::decodeId($id);
        if (!DB::table('products')->where('id', $decodedId)->exists()) {
            return response()->json([
                'message' => 'Product not found',
                'status' => 'error'
            ]);
        }
        return response()->json([
            'message' => 'Product exists',
            'status' => 'success'
        ]);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    /**
     * Lấy thông tin chi tiết của sản phẩm bằng ID đã mã hóa.
     *
     * @param string $encodedId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getProductDetails($request)
    {
        $encodedId = $request->input('encodedId');
        $productId = EncryptionModel::decodeId($encodedId);
        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);
    }

    /**
     * Lấy danh sách sản phẩm với tùy chọn tìm kiếm.
     *
     * @param string|null $keyword
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getAllProducts($request)
    {
        try {
            $keyword = $request->input('keyword');
            $productsQuery = self::query();

            if ($keyword) {
                $productsQuery->where('name', 'like', '%' . $keyword . '%');
            }

            // Lọc các sản phẩm có ít nhất một danh mục còn tồn tại
            $products = $productsQuery->whereHas('categories', function ($query) {
                $query->whereNull('deleted_at');
            })
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            if ($products->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'code' => 422,
                    'message' => 'Product Not Found',
                    'errors' => []
                ]);
            }

            $responseData = $products->getCollection()->map(function ($product) {
                // Lọc các danh mục còn tồn tại
                $activeCategories = $product->categories()->whereNull('deleted_at')->get();

                return [
                    'id' => EncryptionModel::encodeId($product->id),
                    'name' => $product->name,
                    'desc' => $product->desc,
                    'category_id' => $activeCategories->pluck('id'), // Lấy danh sách category_id còn tồn tại
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'status' => $product->status,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                ];
            });

            $products->setCollection($responseData);

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => 422,
                'message' => 'System error, please try again later',
                'errors' => []
            ], 422);
        }
    }





    /**
     * Thêm sản phẩm mới vào cơ sở dữ liệu.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function addProduct($request)
    {
        $messages = [
            'name.required' => 'Required field',
            'name.regex' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',
            'name.min' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',
            'name.max' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',

            'price.required' => 'Required field',
            'price.regex' => 'Price must be a integer greater than 0 and up to 12 digits',

            'discount.integer' => 'Discount must be a integer and 0 < Discount < 101',
            'discount.between' => 'Discount must be a integer and 0 < Discount < 101',

            'categories.required' => 'Required field',
            'categories.array' => 'Categories must be an array',

            'desc.required' => 'Required field',
            'desc.max' => 'The length of description must be between 1 and 2000 characters',

            'image.required' => 'Image is required',
            'image.image' => 'The file must be an image'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L}\p{N} ]+$/u|min:3|max:255',
            'price' => 'required|regex:/^[1-9]\d{0,11}$/',
            'discount' => 'nullable|integer|between:0,100',
            'categories' => 'required|array|exists:categories,id',
            'desc' => 'required|max:2000',
            'image' => 'required|image'
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $formattedErrors = [
                'name' => $errors->first('name'),
                'price' => $errors->first('price'),
                'discount' => $errors->first('discount'),
                'categories' => $errors->first('categories'),
                'desc' => $errors->first('desc'),
                'image' => $errors->first('image'),
            ];

            return response()->json([
                'status' => 'error',
                'errors' => $formattedErrors
            ], 422);
        }

        try {
            // Upload ảnh và lấy URL cùng public_id
            $uploadResult = CloudinaryModel::uploadImage($request->file('image'));
            if ($uploadResult['status'] !== 'success') {
                return response()->json([
                    'status' => 'error',
                    'message' => $uploadResult['message']
                ], 500);
            }

            $product = new self();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->desc = $request->desc;
            $product->status = $request->status ?? 1;
            $product->thumbnail = $uploadResult['secure_url'];
            $product->public_id = $uploadResult['public_id'];
            $product->created_at = now();
            $product->updated_at = now();
            $product->save();

            ProductCategory::addProductCategories($product->id, $request->categories);

            return response()->json([
                'status' => 'success',
                'message' => 'Product added successfully',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System error, please try again later'
            ], 500);
        }
    }


    /**
     * Cập nhật thông tin sản phẩm đã tồn tại trong cơ sở dữ liệu.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function editProduct($request)
    {
        $messages = [
            'name.required' => 'Required field',
            'name.regex' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',
            'name.min' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',
            'name.max' => 'The name only includes a-z, A-Z, 0-9, the length must be between 3 and 255 characters',
            'price.required' => 'Required field',
            'price.integer' => 'Price must be an integer greater than 0 and up to 12 digits',
            'price.min' => 'Price must be an integer greater than 0 and up to 12 digits',
            'price.digits_between' => 'Price must be an integer greater than 0 and up to 12 digits',
            'discount.integer' => 'Discount must be an integer and 0 < Discount < 101',
            'discount.between' => 'Discount must be an integer and 0 < Discount < 101',
            'categories.required' => 'Required field',
            'categories.array' => 'Categories must be an array',
            'categories.exists' => 'One or more categories are invalid or deleted.',
            'categories.min' => 'At least one category must be valid.',
            'desc.required' => 'Required field',
            'desc.max' => 'The length of description must be between 1 and 2000 characters',
            'image.image' => 'The file must be an image'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L}\p{N} ]+$/u|min:3|max:255',
            'price' => 'required|integer|min:1|digits_between:1,12',
            'discount' => 'nullable|integer|between:0,100',
            'categories' => 'required|array|exists:categories,id',
            'desc' => 'required|max:2000',
            'image' => 'nullable|image'
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $formattedErrors = [
                'name' => $errors->first('name'),
                'price' => $errors->first('price'),
                'discount' => $errors->first('discount'),
                'categories' => $errors->first('categories'),
                'desc' => $errors->first('desc'),
                'image' => $errors->first('image'),
            ];
            return response()->json([
                'status' => 'error',
                'errors' => $formattedErrors
            ], 422);
        }

        try {
            $id = EncryptionModel::decodeId($request->id);
            $product = self::find($id);

            // Kiểm tra xem sản phẩm có tồn tại
            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The product does not exist.'
                ], 404);
            }

            if ($product->status == 0) { // Kiểm tra xem sản phẩm đã bị xóa chưa
                return response()->json([
                    'status' => 'error',
                    'message' => 'The product has been deleted.'
                ], 404);
            }

            // Kiểm tra các danh mục xem có bị xóa mềm hay không
            $validCategories = [];
            foreach ($request->categories as $categoryId) {
                $category = Category::withTrashed()->find($categoryId);
                if ($category && $category->deleted_at === null) {
                    $validCategories[] = $categoryId; // Lưu danh mục hợp lệ
                }
            }

            // Kiểm tra xem có ít nhất một danh mục hợp lệ hay không
            if (empty($validCategories)) {
                return response()->json([
                    'status' => 'error',
                    'errors' => [
                        'categories' => 'At least one category must be valid and not deleted.'
                    ]
                ], 422);
            }

            // Cập nhật thông tin sản phẩm
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount ?? 0;
            $product->desc = $request->desc;
            $product->status = $request->status ?? 1;

            // Xóa ảnh cũ nếu có ảnh mới được gửi lên
            if ($request->hasFile('image')) {
                // Xóa ảnh cũ từ Cloudinary
                $deleteResult = CloudinaryModel::deleteImage($product->public_id);
                if ($deleteResult['status'] !== 'success') {
                    return response()->json([
                        'status' => 'error',
                        'message' => $deleteResult['message']
                    ], 500);
                }

                // Tải ảnh mới lên và lưu URL
                $uploadResult = CloudinaryModel::uploadImage($request->file('image'));
                if ($uploadResult['status'] !== 'success') {
                    return response()->json([
                        'status' => 'error',
                        'message' => $uploadResult['message']
                    ], 500);
                }

                $product->thumbnail = $uploadResult['secure_url'];
                $product->public_id = $uploadResult['public_id'];
            }

            $product->updated_at = now();
            $product->save();

            // Cập nhật danh mục sản phẩm
            ProductCategory::updateProductCategories($product->id, $validCategories);

            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'System error, please try again later'
            ], 500);
        }
    }




    /**
     * Xóa sản phẩm khỏi cơ sở dữ liệu.
     *
     * @param int $id ID của sản phẩm cần xóa.
     * @return \Illuminate\Http\JsonResponse Phản hồi dưới dạng JSON, bao gồm trạng thái và thông báo.
     */
    public static function destroy($request)
    {
        $id = EncryptionModel::decodeId($request->id);
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'code' => 404,
                'message' => 'Product not found.',
                'errors' => []
            ], 404);
        }

        $productVariantCount = DB::table('product_variants')->where('product_id', $id)->count();
        if ($productVariantCount > 0) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'message' => 'Delete product unsuccessful',
                'errors' => []
            ], 400);
        }

        try {
            $product->delete();

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Product deleted successfully.'
            ]);
        } catch (\Exception $e) {
            // Xử lý lỗi hệ thống
            return response()->json([
                'status' => 'error',
                'code' => 500,
                'message' => 'System error, please try again later.',
                'errors' => []
            ], 500);
        }
    }

    public static function getProductsByCategory($categoryId)
    {
        $products =  self::select('products.*')
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->join('categories', 'product_category.category_id', '=', 'categories.id')
            ->where('categories.id', $categoryId)
            ->get();
        return $products->isEmpty() ? null : $products;
    }
    // Lấy top sản phẩm khic chưa đăng nhập
    public static function getTopProducts()
    {
        return self::select('products.*')
            ->join('behaviors', 'products.id', '=', 'behaviors.product_id')
            ->whereIn('behaviors.action', ['click', 'follow'])
            ->selectRaw('count(behaviors.id) as action_count')
            ->groupBy('products.id')
            ->orderByDesc('action_count')
            ->paginate(4);
    }
    public static function getTopProductsByUserNotInteracted($userId)
    {
        $interactedProductIds = DB::table('behaviors')
            ->where('user_id', $userId)
            ->whereIn('action', ['click', 'follow'])
            ->pluck('product_id');
    
        return DB::table('products as similar_products')
            ->select('similar_products.id', 'similar_products.name','similar_products.price'
            ,'similar_products.discount','similar_products.thumbnail') // Liệt kê các trường cần thiết từ `similar_products`
            ->join('product_category as pc_user', 'pc_user.product_id', '=', 'similar_products.id')
            ->join('product_category as pc_similar', 'pc_user.category_id', '=', 'pc_similar.category_id')
            ->join('products', 'products.id', '=', 'pc_similar.product_id')
            ->whereNotIn('similar_products.id', $interactedProductIds)
            ->selectRaw('COUNT(pc_similar.category_id) as similarity_count')
            ->groupBy('similar_products.id', 'similar_products.name') // Nhóm theo các cột đã chọn
            ->orderByDesc('similarity_count')
            ->paginate(4);
    }
    
    /* Lấy top sản phẩm mà user chưa tương tác hoặc chưa
    có user_id, sắp xếp ngẫu nhiên để tránh trùng lặp sản phẩm*/
    public static function getTopProductsByUserInteracted($userId)
    {
        // Truy vấn các sản phẩm liên quan dựa trên các sản phẩm mà user đã tương tác
        $relatedProducts = self::select('similar_products.id', 'similar_products.name', 'similar_products.price', DB::raw('NULL as interaction_count'))
            ->join('behaviors', 'products.id', '=', 'behaviors.product_id')
            ->leftJoin('product_category as pc_user', 'pc_user.product_id', '=', 'products.id')
            ->leftJoin('product_category as pc_similar', 'pc_user.category_id', '=', 'pc_similar.category_id')
            ->leftJoin('products as similar_products', 'similar_products.id', '=', 'pc_similar.product_id')
            ->whereIn('behaviors.action', ['click', 'follow'])
            ->where('behaviors.user_id', $userId)
            ->whereNotNull('similar_products.id')
            ->whereNotNull('similar_products.name')
            ->whereNotNull('similar_products.price');

        // Truy vấn các sản phẩm có lượt tương tác cao từ tất cả các user
        $popularProducts = self::select('products.id', 'products.name', 'products.price', DB::raw('COUNT(behaviors.id) as interaction_count'))
            ->join('behaviors', 'products.id', '=', 'behaviors.product_id')
            ->whereIn('behaviors.action', ['click', 'follow'])
            ->groupBy('products.id', 'products.name', 'products.price') // Cần nhóm theo các trường đã chọn
            ->orderByDesc('interaction_count');

        // Kết hợp hai truy vấn và loại bỏ các bản ghi trùng lặp theo id
        $combinedQuery = $relatedProducts->union($popularProducts)
            ->distinct()
            ->orderByRaw('RAND()');

        // Lấy kết quả và phân trang
        return $combinedQuery->paginate(4);
    }
    public static function getProductsBySimilarNameAndCategory($productId)
    {
        $product = self::select('name')
            ->where('id', $productId)
            ->first();
        $productName = $product->name;
        $keywords = explode(' ', $productName);
        $categoryIds = DB::table('product_category')
            ->where('product_id', $productId)
            ->pluck('category_id');
        $categoryProducts = self::select('products.*', DB::raw('NULL AS interaction_count'))
            ->join('product_category', 'products.id', '=', 'product_category.product_id')
            ->whereIn('product_category.category_id', $categoryIds)
            ->where('products.id', '!=', $productId)
            ->distinct()
            ->get();
        // Khởi tạo mảng similarProducts rỗng
        $similarProducts = [];
        // Lặp qua từng từ khóa
        foreach ($keywords as $keyword) {
            // Tìm sản phẩm tương tự theo từng từ khóa
            $products = self::where('products.name', 'LIKE', '%' . $keyword . '%')
                ->where('products.id', '!=', $productId) // Loại bỏ sản phẩm chính nó
                ->distinct()
                ->get();
            // Thêm từng sản phẩm vào mảng similarProducts
            foreach ($products as $product) {
                // Chỉ thêm sản phẩm nếu nó chưa tồn tại trong mảng similarProducts
                if (!in_array($product, $similarProducts)) {
                    $similarProducts[] = $product;
                }
            }
        }
        return response()->json(['similar' => $similarProducts, 'catepro' => $categoryProducts]);
    }
    public function getProductById($id)
    {
        return self::findOrFail($id);
    }
}
