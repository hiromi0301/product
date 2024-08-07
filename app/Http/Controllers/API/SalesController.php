<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    public function purchase(Request $request)
    {
        //$productId = new product;
        $quantity = $request->input('quantity', 1);
        $id = $request->input('product_id');
        
        //return response()->json($id);
        //$product = $productId->getProductById($id); 
        $product = Product::find($id);
        //return response()->json($product);
        //$product = Product::all();
        $stock = $request->input('product_stock');

        if (!$product) {
            return response()->json(['message' => '商品が存在しません']);
        }
        if ($product->stock <= 0) {
            return response()->json(['message' => '商品が在庫不足です']);
        }
    
        //$product->stock -= $quantity; 
        //$product->save();

        try{
            DB::beginTransaction();

            $product->stock -= $quantity;

            $product->save();

            $sale = new Sale([
                'product_id' => $id,
            ]);
        
            $sale->save();

            DB::commit();
        
        } catch (Throwable $e){
            DB::rollBack();
        }
    
    
       
        return response()->json(['message' => '購入成功']);
        //return response()->json($sale);
    }
}
