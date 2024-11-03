<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function getCartByUserId(){
        return CartModel::getUserCart();
    }
    public function deleteCartItem(Request $request) {
        return CartModel::deleteItemFromCart($request);
    }
    public function updateCartItem(Request $request) {
        return CartModel::updateQuantityInCart($request);
    }
}
