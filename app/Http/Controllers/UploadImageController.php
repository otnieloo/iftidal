<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UploadImageController extends Controller
{


  /**
   * Processing iamge upload
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function process(Request $request)
  {

    if ($request->has('tmp_video')) {

      $file = $request->file('tmp_video')->store('tmp');
    } else {

      if (is_array($request->file('tmp'))) {
        $file = $request->file('tmp')[0]->store('tmp');
      } else {
        $file = $request->file('tmp')->store('tmp');
      }
    }


    return response($file, 200)->header('Content-Type', 'text/html');
  }



  /**
   * Revert iamge upload
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function revert(Request $request)
  {
    $file = $request->getContent();
    Storage::delete($file);
  }


  /**
   * Load image
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function load(Request $request)
  {
    $request->validate([
      'id' => ['required']
    ]);


    $filePath = '';
    if ($request->has('video')) {
      // Get the file path from storage (this depends on your setup, you can use a database to map IDs)
      $filePath = public_path('storage/' . $request->id);
    } else {
      $productImageId = $request->id;
      $productImage = ProductImage::find($productImageId);

      // Get the file path from storage (this depends on your setup, you can use a database to map IDs)
      $filePath = public_path('storage/' . $productImage->product_image);
    }

    // Check if the file exists
    if (file_exists($filePath)) {
      // Return the file as a response
      $mimeType = mime_content_type($filePath);
      return Response::make(file_get_contents($filePath), 200)
        ->header("Content-Type", $mimeType);
    } else {
      // File not found
      return response()->json(['message' => 'File not found'], 404);
    }
  }
}
