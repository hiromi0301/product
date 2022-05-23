<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //テーブル名
    protected $table = 'products';

    //可変項目
    protected $fillable =
    [
        'product_name',
        'content',
        'price',
        'stock',
        'img_path',
        'company_id',

    ];


    public function company(){
    return $this->belongsTo('App\Models\Company');
    }

}
