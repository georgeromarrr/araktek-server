<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addtocart(Request $request) {
        if (auth('sanctum')->check()) {

            $user_id = auth('sanctum')->user()->id;
            $product_id = $request->product_id;
            $qty = $reqiest->qty;

            $product_check = Product::where('id')->first();

            if($product_check) {

                if(Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {

                    return response()->json([
                        'status' => 409,
                        'message' => $productCheck->name. 'Alreay added to cart'
                    ]);
                }
                else {

                    $cartitem = new Cart;
                    $cartitem->user_id = $user_id;
                    $cartitem->product_id = $product_id;
                    $cartitem->qty = $qty;
                    $cartitem->save();

                    return response()->json([
                        'status' => 201,
                        'message' => 'Product has been added'
                    ]);
                }
            }
            else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Product not Found'
                ]);
            }

           
        }
        else {
            return response()->json([
                'status' => 401,
                'message' => 'login to add to cart'
            ]);
        }
    }
}
