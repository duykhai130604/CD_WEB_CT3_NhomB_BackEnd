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
        $keyword = $request->input('keyword');
        $productsQuery = self::query();
        if ($keyword) {
            $productsQuery->where('name', 'like', '%' . $keyword . '%');
        }
        $products = $productsQuery->orderBy('updated_at', 'desc')->paginate(10);
        if ($products->isEmpty()) {
            return response()->json(['message' => 'Product Not Found']);
        }
        $responseData = $products->getCollection()->map(function ($product) {
            return [
                'id' => EncryptionModel::encodeId($product->id),
                'name' => $product->name,
                'desc' => $product->desc,
                'category_id' => $product->category_id,
                'price' => $product->price,
                'discount' => $product->discount,
                'status' => $product->status,
                'created_at' => $product->created_at,
                'updated_at' => $product->updated_at,
            ];
        });
        $products->setCollection($responseData);
        return response()->json($products);
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
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L}\p{N} ]+$/u|min:3|max:255',
            'price' => 'required|regex:/^[1-9]\d{0,11}$/',
            'discount' => 'nullable|integer|between:0,100',
            'categories' => 'required|array|exists:categories,id',
            'desc' => 'required|max:2000',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $formattedErrors = [
                'name' => $errors->first('name'),
                'price' => $errors->first('price'),
                'discount' => $errors->first('discount'),
                'categories' => $errors->first('categories'),
                'desc' => $errors->first('desc'),
            ];

            return response()->json([
                'status' => 'error',
                'errors' => $formattedErrors
            ], 422);
        }

        try {
            $product = new self();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount;
            $product->desc = $request->desc;
            $product->status = $request->status ?? 1;
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
            'price.integer' => 'Price must be a integer greater than 0 and up to 12 digits',
            'price.min' => 'Price must be a integer greater than 0 and up to 12 digits',
            'price.digits_between' => 'Price must be a integer greater than 0 and up to 12 digits',
            'discount.integer' => 'Discount must be a integer and 0 < Discount < 101',
            'discount.between' => 'Discount must be a integer and 0 < Discount < 101',
            'categories.required' => 'Required field',
            'categories.array' => 'Categories must be an array',
            'desc.required' => 'Required field',
            'desc.max' => 'The length of description must be between 1 and 2000 characters'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L}\p{N} ]+$/u|min:3|max:255',
            'price' => 'required|integer|min:1|digits_between:1,12',
            'discount' => 'nullable|integer|between:0,101',
            'categories' => 'required|array|exists:categories,id',
            'desc' => 'required|max:2000',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $formattedErrors = [
                'name' => $errors->first('name'),
                'price' => $errors->first('price'),
                'discount' => $errors->first('discount'),
                'categories' => $errors->first('categories'),
                'desc' => $errors->first('desc'),
            ];
            return response()->json([
                'status' => 'error',
                'errors' => $formattedErrors
            ], 422);
        }

        try {
            $id = EncryptionModel::decodeId($request->id);
            $product = self::find($id);
            if (!$product || $product->status == 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'The product has been deleted.'
                ], 404);
            }

            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount ?? 0;
            $product->desc = $request->desc;
            $product->status = $request->status ?? 1;
            $product->updated_at = now();
            $product->save();

            // Cập nhật danh mục sản phẩm
            ProductCategory::updateProductCategories($product->id, $request->categories);

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
                'message' => 'Product not found.'
            ], 404);
        }
        $productVariantCount = DB::table('product_variants')->where('product_id', $id)->count();
        if ($productVariantCount > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Delete product unsuccessful'
            ], 400);
        }
        $product->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted successfully.'
        ]);
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
    public static function getTopProducts()
    {
        return self::select('products.*')
            ->join('behaviors', 'products.id', '=', 'behaviors.product_id')
            ->whereIn('behaviors.action', ['click', 'follow'])
            ->selectRaw('count(behaviors.id) as action_count')
            ->groupBy('products.id')
            ->orderByDesc('action_count')
            ->limit(8)
            ->get();
    }
}
