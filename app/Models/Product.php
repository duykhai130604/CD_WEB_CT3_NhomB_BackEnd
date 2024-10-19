<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Product extends Model
{
    use HasFactory;
    public static function getAllProducts($keyword)
    {
        $productsQuery = self::query();
        if ($keyword) {
            $productsQuery->where('name', 'like', '%' . $keyword . '%');
        }
        return $productsQuery->orderBy('updated_at', 'desc')->paginate(2);
    }

    // Hàm thêm sản phẩm mới
    public static function addProduct($request)
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
            'category_id.required' => 'Required field',
            'category_id.exists' => 'Invalid category selection',
            'desc.required' => 'Required field',
            'desc.max' => 'The length of description must be between 1 and 2000 characters'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z0-9 ]+$/|min:3|max:255',
            'price' => 'required|integer|min:1|digits_between:1,12',
            'discount' => 'nullable|integer|between:0,101',
            'category_id' => 'required|exists:categories,id',
            'desc' => 'required|max:2000',
        ], $messages);

        if ($validator->fails()) {
            return [
                'status' => 'error',
                'errors' => $validator->errors(),
            ];
        }

        try {
            $product = new self();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->discount = $request->discount ?? 0;
            $product->category_id = $request->category_id;
            $product->desc = $request->desc;
            $product->status = $request->status ?? 1;
            $product->created_at = now();
            $product->updated_at = now();
            $product->save();

            return [
                'status' => 'success',
                'message' => 'Product added successfully',
                'product' => $product
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'System error, please try again later'
            ];
        }
    }
}
