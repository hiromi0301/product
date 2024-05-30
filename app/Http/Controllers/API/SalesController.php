<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $id = $request->input('product_id');
        $product = $productId->getProductById($id); 
    
        if (!$product) {
            return response()->json(['message' => '商品が存在しません']);
        }
        if ($product->stock < $quantity) {
            return response()->json(['message' => '商品が在庫不足です']);
        }
    
        $product->stock -= $quantity; 
        $product->save();
    
    
        $sale = new Sale([
            'product_id' => $productId,
        ]);
    
        $sale->save();
    
        return response()->json(['message' => '購入成功']);
        return response()->json($sale);
    }
}
