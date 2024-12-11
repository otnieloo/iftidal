<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $response = create_response();

        $vendor_id = $request->vendor_id;
        $products = Product::with('product_images', 'variations', 'product_package')->where('vendor_id', $vendor_id)->get();

        if($products->isEmpty()){
            return response()->json($response, 404);
        }

        $response->status       = TRUE;
        $response->status_code  = 200;
        $response->data         = $products;
        $response->message      = "Found!";

        return response()->json($response, 200);
    }
}
