<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Sale;

class Sale extends Model
{
    use HasFactory;
    
    protected $table = 'sale';
    protected $dates = ['created_at','updated_at'];
    protected $fillable = ['product_id'];



    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

}
