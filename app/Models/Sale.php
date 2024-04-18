<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Modele\Sale;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ['id', 'product_id'];

    public function dec(){
        $sales = DB::table('sales')
        ->where('product_id')
        ->join('products','sales.product_id','=','producys.id')
        ->decrement('stock',1);
    
        return $sales;
    }
    


}
