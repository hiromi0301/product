<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        $productId = new product;
        $quantity = $request->input('quantity', 1);

        $id = $request->input('product_id');
        //$product = $productId->getProductById($id); 
        $product = Product::find($productId);
        //$product = Product::all();
        $stock = $request->input('product_stock');

        if (!$product) {
            return response()->json(['message' => '商品が存在しません']);
        }
        if ($product->stock -= $quantity) {
            return response()->json(['message' => '商品が在庫不足です']);
        }
    
        $product->stock = $quantity; 
        $product->save();
    
    
        $sale = new Sale([
            'product_id' => $productId,
        ]);
    
        $sale->save();
    
        return response()->json(['message' => '購入成功']);
        return response()->json($sale);
    }
}
