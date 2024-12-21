<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $response = create_response();

        $vendor_id = $request->vendor_id;
        $vendor = Vendor::select('id', 'company_name', 'logo')->with(['product' => function($q){
            $q->with('product_images', 'variations', 'product_package', 'vendor:id,company_name,logo');
        }])->where('id', $vendor_id)->first();


        if(!$vendor){
            return response()->json($response, 404);
        }

        $response->status       = TRUE;
        $response->status_code  = 200;
        $response->data         = $vendor;
        $response->message      = "Found!";

        return response()->json($response, 200);
    }
}
