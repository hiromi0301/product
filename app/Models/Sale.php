<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Modele\Sale;

class Sales extends Model
{
    protected $fillable = ['product_id', ]; 

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
