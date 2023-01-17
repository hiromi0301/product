<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
        $company_keyword = $request->company_id;
       
        $query = Product::query();
    
        if(!empty($product_keyword)) {
                        
            $query->where('product_name', 'LIKE', "%{$product_keyword}%");
                                      }

        if(!empty($company_keyword)){           

        $query->where('company_id', 'LIKE', "%{$company_keyword}%");
                                     }
        
            return $query->get();                             

    }                         


    public static function getStore(ProductRequest $request){


        $inputs = $request->all();
      
        $product = new Product;

        $img = $request->img_path->getClientOriginalName();

        if (!is_null($img)) {

            $path = $request->img_path->storeAs('',$img,'public');
                            }


        \DB::beginTransaction();

        try{
            //商品を登録
            Product::create([
            'img_path' => $path,
            'company_id' => $inputs['company_id'],
            'product_name' => $inputs['product_name'],
            'price' => $inputs['price'],
            'stock' => $inputs['stock'],
            'content' => $inputs['content'],
                              ]);

        \DB::commit();
            } catch(\Throwable $e){
            \DB::rollback();
            abort(500);

            return $product->get(); 

                                    }
                                            }
   
   
   
   
    public static function getUpdate($request){
        
        
        $inputs = $request->all();


        $product = new Product;

        $img = $request->img_path->getClientOriginalName();
      
        if (!is_null($img)) {

            $path = $request->img_path->storeAs('',$img,'public');
         
                             }
        
        \DB::beginTransaction();
        try{
        $product = Product::find($inputs['id']);
        $product->fill([
            'product_name' => $inputs['product_name'],
            'content' => $inputs['content'],
            'price' => $inputs['price'],    
            'stock' => $inputs['stock'],
            'company_id' => $inputs['company_id'],
            'img_path' => $path,
                  
                        ]);
        $product->save();
        \DB::commit();
        
        } catch(\Throwable $e){
            \DB::rollback();
            throw new \Exception($e->getMessage());

                               }
        \Session::flash('err_msg','商品を更新しました');
        //return redirect(route('index'));
          return $product->get();               
                                                }

    

    public static function getDelete($id){

        \DB::beginTransaction();
        try{
            DB::beginTransaction();
            //商品を登録
            Product::destroy($id);
            DB::commit();

            }catch(\Throwable $e){
                abort(500);

        return $product->get();           
   
                                 }
     


                                                }





}
