<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class FrontendController extends Controller
{

    public function category()
    {
        $category = Category::where('status', '0')->get();
        return response()->json([
            'status'=>200,
            'category'=>$category
        ]);
    }

    public function product($slug)
    {
        $category = Category::where('slug', $slug)->where('status', '0')->first();
        if($category){
            $product = Product::where('category_id', $category->id)->where('status','0')->get();
            if($product){
                return response()->json([
                    'status'=>200,
                    'product_data'=>[
                        'product'=>$product,
                        'category'=>$category,
                    ]
                ]);     
            }
            else{
            return response()->json([
                'status'=>400,
                'message'=>'No Such Product Available'
            ]);
            }
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Category Available'
            ]);
        }
    }

    
    public function viewproduct($category_slug, $slug){

        $category = Category::where('slug', $slug)->where('status', '0')->first();
        if($category){
            $product = Product::where('category_id', $category->id)->where('slug', $slug)->where('status','0')->first();
            if($product){
                return response()->json([
                    'status'=>200,
                    'product_data'=>[
                        'product'=>$product,
                    ]
                ]);     
            }
            else{
            return response()->json([
                'status'=>400,
                'message'=>'No Such Product Available'
            ]);
            }
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Category Available'
            ]);
        }
    }
    public function index() {
        $products = Product::all();
        return response()->json([
            'status' => 200,
            'products' => $products
        ]); 
    }

    public function getBrand() {

        $brand= Brand::all();
        return response()->json([
            'status' => 200,
            'brand' => $brand
        ]);
    }
    }

