<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;



class Product extends Model
{

    use Sortable;

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
        'created_at',
        'updated_at'

    ];


    public function company(){

        //$product_keyword = $request->product_name;
        //$company_keyword = $request->company_id;   
    return $this->belongsTo('App\Models\Company');
    }


    public function getData(){

        $data = DB::table($this->table)->get();

        return $data;
    }


    public static function getList($request){

        $product_keyword = $request->product_name;
        $company_keyword = $request->company_name;
       
        $query = Product::query();
    
        if(!empty($product_keyword)) {
                        
        $query->where('product_name', 'LIKE', "%{$product_keyword}%");
        
        }

        if(!empty($company_keyword)){           

        $query->where('company_id', '=', $company_keyword);
        
        }

        $price_upper = $request->input('price_upper'); //価格最大値
        $price_lower = $request->input('proce_lower'); //価格最小値

        $stock_upper = $request->input('stock_upper'); //在庫数最大値
        $stock_lower = $request->input('stock_lower'); //在庫数最小値


        /* 価格最大値から検索処理 */
        if(!empty($price_upper)){ $query->where('price', '<=',$price_upper);
        }

        /* 価格最小値から検索処理 */
        if(!empty($price_lower)){ $query->where('price', '>=',$price_lower);
        }


        /* 在庫数最大値から検索処理 */
        if(!empty($stock_upper)){ $query->where('stock', '<=',$stock_upper);
        }

        /* 在庫数最小値から検索処理 */
        if(!empty($stock_lower)){ $query->where('stock', '>=',$stock_lower);
        }
        
        return $query->get();                             

    }                         


    public static function getStore($request){


        $inputs = $request->all();
      
        $product = new Product;

        $companies = $request->all(); 
    
    }
   

    public static function getEdit($id){
   
        $product = Product::find($id);

        return $product->get();
                                                                                        
    }
   
   
    public static function getUpdate($request){
        
        $inputs = $request->all();

        $product = new Product;
        
        return $product->get();               
    
    }
    

    public static function getDelete($id){

        if (empty($id)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('index'));
    
        }

        //\DB::beginTransaction();
        //try{
           // DB::beginTransaction();
            //商品を登録
           // Product::destroy($id);
           // DB::commit();

          //  }catch(\Throwable $e){
            //    abort(500);

        //return $product->get();           
        return $product->destroy($id);
                               //  }
     


    }





}
