<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductVariantModel extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'product_variants';
    public static function getAllVariantsByProductId($request)
    {
        $encodedId = $request->input('encodedId');
        $keyword = $request->input('keyword');
        $productId = EncryptionModel::decodeId($encodedId);
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
        }
        $variantsQuery = ProductVariantModel::where('product_id', $productId)
            ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
            ->join('colors', 'product_variants.color_id', '=', 'colors.id')
            ->select('product_variants.*', 'sizes.name as size_name', 'colors.name as color_name');

        // Nếu có từ khóa, thêm điều kiện tìm kiếm theo size.name
        if ($keyword) {
            $variantsQuery->where('sizes.name', 'like', '%' . $keyword . '%');
        }

        // Sắp xếp theo ngày cập nhật và phân trang
        $variants = $variantsQuery->orderBy('product_variants.updated_at', 'desc')->paginate(2);

        // Nếu không có biến thể nào được tìm thấy
        if ($variants->isEmpty()) {
            return response()->json(['status' => 'success', 'message' => 'Product Variants Not Found'], 200);
        }

        // Xử lý và trả về dữ liệu
        $responseData = $variants->getCollection()->map(function ($variant) {
            return [
                'id' => EncryptionModel::encodeId($variant->id),
                'product_id' => EncryptionModel::encodeId($variant->product_id),
                'color_id' => EncryptionModel::encodeId($variant->color_id),
                'size_id' => EncryptionModel::encodeId($variant->size_id),
                'size_name' => $variant->size_name,
                'color_name' => $variant->color_name,
                'quantity' => $variant->quantity,
                'status' => $variant->status,
                'created_at' => $variant->created_at,
                'updated_at' => $variant->updated_at,
            ];
        });

        $variants->setCollection($responseData);
        return response()->json([
            'status' => 'success',
            'variants' => $variants,
        ]);
    }


    public static function addProductVariant($productId, $colorId, $sizeId, $quantity, $status)
    {
        return DB::table('product_variants')->insertGetId([
            'product_id' => $productId,
            'color_id' => $colorId,
            'size_id' => $sizeId,
            'quantity' => $quantity,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    // Add variants
    public static function addProductVariantWithImages($request)
    {
        $decodedProductId = EncryptionModel::decodeId($request->input('product_id'));
        $decodedColorId = EncryptionModel::decodeId($request->input('color_id'));
        $decodedSizeId = EncryptionModel::decodeId($request->input('size_id'));
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $images = $request->file('images');

        $validationData = [
            'quantity' => $quantity,
            'images' => $images,
            'color_id' => $decodedColorId,
            'size_id' => $decodedSizeId,
        ];

        $messages = [
            'quantity.required' => 'Required field',
            'quantity.integer' => 'Quantity must be an integer and 0 < Quantity < 1000',
            'quantity.between' => 'Quantity must be an integer and 0 < Quantity < 1000',
            'images.required' => 'Required field',
            'images.array' => 'You can upload up to 10 images',
            'images.max' => 'You can upload up to 10 images',
            'images.*.image' => 'Format images only include .jpg, .png, .gif',
            'images.*.mimes' => 'Format images only include .jpg, .png, .gif',
            'images.*.max' => 'Image size must be < 5 MB',
            'color_id.required' => 'Required field',
            'color_id.exists' => 'Invalid color selection',
            'size_id.required' => 'Required field',
            'size_id.exists' => 'Invalid size selection',
        ];

        $validator = Validator::make($validationData, [
            'quantity' => 'required|integer|between:1,999',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,png,gif|max:5120',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => [
                    'quantity' => $validator->errors()->first('quantity'),
                    'images' => $validator->errors()->first('images.*'),
                    'color_id' => $validator->errors()->first('color_id'),
                    'size_id' => $validator->errors()->first('size_id'),
                ]
            ], 422);
        }

        $totalSize = array_reduce($images, function ($carry, $image) {
            return $carry + $image->getSize();
        }, 0);

        if ($totalSize > 40 * 1024 * 1024) {
            return response()->json(['status' => 'error', 'message' => 'Total images size must be < 40MB'], 400);
        }
        if (!DB::table('products')->where('id', $decodedProductId)->exists()) {
            return response()->json(['status' => 'error', 'message' => 'Product not found.'], 400);
        }
        DB::beginTransaction();
        try {
            $existingVariant = DB::table('product_variants')
                ->where('product_id', $decodedProductId)
                ->where('color_id', $decodedColorId)
                ->where('size_id', $decodedSizeId)
                ->first();

            if ($existingVariant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'A product variant with this color and size already exists.'
                ], 409);
            }

            $variantId = self::addProductVariant($decodedProductId, $decodedColorId, $decodedSizeId, $quantity, $status);

            foreach ($images as $image) {
                $uploadedImage = CloudinaryModel::uploadImage($image);
                if ($uploadedImage['status'] === 'success') {
                    $result = ProductImageModel::addProductImage($variantId, $uploadedImage);
                    if ($result['status'] === 'error') {
                        DB::rollBack();
                        return response()->json(['status' => 'error', 'message' => 'Failed to upload one or more images.'], 500);
                    }
                } else {
                    DB::rollBack();
                    return response()->json(['status' => 'error', 'message' => 'Failed to upload one or more images.'], 500);
                }
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Product variant and images uploaded successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'System error, please try again later'], 500);
        }
    }



    // Delete variant
    // public static function deleteProductVariantWithImages($request)
    // {
    //     $variantId = EncryptionModel::decodeId($request->input('variant_id'));
    //     DB::beginTransaction();
    //     try {
    //         $variant = DB::table('product_variants')->where('id', $variantId)->first();
    //         if (!$variant) {
    //             return response()->json(['status' => 'error', 'message' => 'Product variant not found.'], 404);
    //         }
    //         $images = DB::table('product_images')->where('variant_id', $variantId)->get();
    //         foreach ($images as $image) {
    //             $deletionResult = CloudinaryModel::deleteImage($image->public_id);

    //             if ($deletionResult['status'] !== 'success') {
    //                 DB::rollBack();
    //                 return response()->json([
    //                     'status' => 'error',
    //                     'message' => "Failed to delete image with ID: {$image->public_id}."
    //                 ], 500);
    //             }
    //             DB::table('product_images')->where('id', $image->id)->delete();
    //         }

    //         DB::table('product_variants')->where('id', $variantId)->delete();
    //         DB::commit();
    //         return response()->json(['status' => 'success', 'message' => 'Product variant and images deleted successfully.'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json(['status' => 'error', 'message' => 'System error, please try again later'], 500);
    //     }
    // }
    public static function deleteProductVariant($request)
    {
        $variantId = EncryptionModel::decodeId($request->input('variant_id'));
        DB::beginTransaction();
        try {
            $variant = ProductVariantModel::find($variantId);
            if (!$variant) {
                return response()->json(['status' => 'error', 'message' => 'Product variant not found.'], 404);
            }
            $variant->delete();
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Product variant deleted successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'System error, please try again later'], 500);
        }
    }
    // Edit variant
    // Edit variant
    public static function editVariant($request)
    {
        Log::info("All", $request->all());
        // Lấy ID biến thể từ request
        $variantId = EncryptionModel::decodeId($request->input('variant_id'));
        $decodedColorId = EncryptionModel::decodeId($request->input('color_id'));
        $decodedSizeId = EncryptionModel::decodeId($request->input('size_id'));
        $quantity = $request->input('quantity');
        $status = $request->input('status');
        $images = $request->file('images');

        // Dữ liệu để kiểm tra tính hợp lệ
        $validationData = [
            'quantity' => $quantity,
            'color_id' => $decodedColorId,
            'size_id' => $decodedSizeId,
            'images' => $images,
        ];

        // Thông điệp lỗi
        $messages = [
            'quantity.required' => 'Required field',
            'quantity.integer' => 'Quantity must be an integer and 0 < Quantity < 1000',
            'quantity.between' => 'Quantity must be an integer and 0 < Quantity < 1000',
            'images.array' => 'You can upload up to 10 images',
            'images.max' => 'You can upload up to 10 images',
            'images.*.image' => 'Format images only include .jpg, .png, .gif',
            'images.*.mimes' => 'Format images only include .jpg, .png, .gif',
            'images.*.max' => 'Image size must be < 5 MB',
            'color_id.required' => 'Required field',
            'color_id.exists' => 'Invalid color selection',
            'size_id.required' => 'Required field',
            'size_id.exists' => 'Invalid size selection',
        ];

        // Xác thực dữ liệu
        $validator = Validator::make($validationData, [
            'quantity' => 'required|integer|between:1,999',
            'images' => 'nullable|array|max:10', // Hình ảnh là tùy chọn
            'images.*' => 'image|mimes:jpg,png,gif|max:5120',
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
        ], $messages);

        // Nếu xác thực thất bại
        if ($validator->fails()) {
            $errors = $validator->errors();
            $formattedErrors = [
                'quantity' => $errors->first('quantity'),
                'images' => $errors->first('images.*'),
                'color_id' => $errors->first('color_id'),
                'size_id' => $errors->first('size_id'),
            ];

            return response()->json([
                'status' => 'error',
                'errors' => $formattedErrors
            ], 422);
        }

        DB::beginTransaction();
        try {
            // Kiểm tra xem variant có tồn tại không
            $existingVariant = DB::table('product_variants')->where('id', $variantId)->first();

            if (!$existingVariant) {
                return response()->json(['status' => 'error', 'message' => 'Variant not found.'], 404);
            }

            // Kiểm tra xem biến thể đã tồn tại với color_id và size_id đã cho
            $duplicateVariant = DB::table('product_variants')
                ->where('product_id', $existingVariant->product_id) // Sử dụng product_id từ biến thể hiện tại
                ->where('color_id', $decodedColorId)
                ->where('size_id', $decodedSizeId)
                ->where('id', '!=', $variantId) // Loại trừ chính nó
                ->first();

            if ($duplicateVariant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'A product variant with this color and size already exists.'
                ], 409);
            }

            // Cập nhật thông tin variant
            DB::table('product_variants')->where('id', $variantId)->update([
                'quantity' => $quantity,
                'status' => $status,
                'color_id' => $decodedColorId,
                'size_id' => $decodedSizeId,
                'updated_at' => now(),
            ]);

            // Nếu có hình ảnh mới, xử lý việc cập nhật hình ảnh
            if ($images) {
                // Lấy danh sách public_id của các hình ảnh cũ
                $oldImages = ProductImageModel::getImagesByVariantId($variantId);
                foreach ($oldImages as $oldImage) {
                    // Xóa hình ảnh cũ khỏi Cloudinary
                    CloudinaryModel::deleteImage($oldImage->public_id);
                }
                // Xóa các hình ảnh cũ khỏi bảng product_images
                ProductImageModel::deleteImagesByVariantId($variantId);

                foreach ($images as $image) {
                    $uploadedImage = CloudinaryModel::uploadImage($image);
                    if ($uploadedImage['status'] === 'success') {
                        $result = ProductImageModel::addProductImage($variantId, $uploadedImage);
                        if ($result['status'] === 'error') {
                            DB::rollBack();
                            return response()->json(['status' => 'error', 'message' => 'Failed to upload one or more images.'], 500);
                        }
                    } else {
                        DB::rollBack();
                        return response()->json(['status' => 'error', 'message' => 'Failed to upload one or more images.'], 500);
                    }
                }
            }

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Product variant updated successfully.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'System error, please try again later'], 500);
        }
    }


    public static function getVariantByVariantId($request)
    {
        // Giải mã variant_id từ yêu cầu
        $variantId = EncryptionModel::decodeId($request->input('variant_id'));

        // Tìm biến thể theo ID
        $variant = ProductVariantModel::join('sizes', 'product_variants.size_id', '=', 'sizes.id')
            ->join('colors', 'product_variants.color_id', '=', 'colors.id')
            ->select('product_variants.*', 'sizes.name as size_name', 'colors.name as color_name')
            ->where('product_variants.id', $variantId)
            ->first();

        // Kiểm tra nếu không tìm thấy biến thể
        if (!$variant) {
            return response()->json(['status' => 'error', 'message' => 'Product variant not found.'], 404);
        }

        // Mã hóa lại các ID trước khi trả về
        $responseData = [
            'id' => EncryptionModel::encodeId($variant->id),
            'product_id' => EncryptionModel::encodeId($variant->product_id),
            'color_id' => EncryptionModel::encodeId($variant->color_id),
            'size_id' => EncryptionModel::encodeId($variant->size_id),
            'size_name' => $variant->size_name,
            'color_name' => $variant->color_name,
            'quantity' => $variant->quantity,
            'status' => $variant->status,
            'created_at' => $variant->created_at,
            'updated_at' => $variant->updated_at,
            'images' => [], // Khởi tạo mảng hình ảnh
        ];

        // Lấy tất cả hình ảnh cho biến thể
        $images = ProductImageModel::where('variant_id', $variantId)->pluck('url')->toArray();
        $responseData['images'] = $images;

        return response()->json([
            'status' => 'success',
            'variant' => $responseData,
        ]);
    }
}
