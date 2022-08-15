<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'message' => 'required'
        ]);

        if ($validator -> fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages(),
            ]);
        }
        else {

            $review = new Review;
            $review->message = $request->input('message');
             
            $review->save();

            return response()->json([
                'status' => 200,
                'message' => 'Your Review has been sent',
            ]);
        }

    }
}
