<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{

    //①（M）Product Modelを呼び出す
    //②（C）ContorollerからBladeに渡す
    //③（V）Bladeで表示する
    
    /**
     * 商品一覧を表示する
     * 
     * @return view
     */
    public function index(){
   
        

       // $products = Product::with('company:id,name')->orderBy('id', 'asc')->paginate(20);
        $products = Product::with('company:id,company_name')->get();

        //dd($products);
       
        return view('product.list',['products' => $products]);
       
       
        
   } 
   


    /**
     * 商品詳細を表示する
     * @param int $id
     * @return view
     */
    public function detail($id){
   
        $product = Product::find($id);
        
       
        if (is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('index'));

        }

       return view('product.detail',
        ['product' => $product]);

   } 

    /**
     * 商品登録画面を表示する
     * 
     * @return view
     */


public function create() {

    return   view('product.form');
}

    /**
     * 商品を登録する
     * 
     * @return view
     */


    public function store(ProductRequest $request) {
        
        //商品のデータを受け取る
        $inputs=$request->all();
      // dd($inputs);
        $product=new Product;
        //$product->request();
        //$product->company_id=$request->company()->id;
        //$product->product_name=$request->product_name;
        //$product->content=$request->content;
        //$product->product_price=$request->product_price;
        //$product->product_stock=$request->product_stock;
        //$product->product_img_path=$request->product_img_path;
        //$product->company_name=$request->company()->company_name;
        //$product->save();

        $img = $request->file('img_path');
        $path = $img->storeAs($img,'public');


       // dd($img);


        \DB::beginTransaction();

        try{
         //商品を登録
         Product::create($inputs);

         \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);

        }
       

        \Session::flash('err_msg','商品を登録しました');
        return redirect(route('index'));
        

    }


    /**
     * 商品編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function edit($id){
   
        $product = Product::find($id);
        
       
        if (is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('index'));

        }

       return view('product.edit',
        ['product' => $product]);

   } 


     /**
     * 商品を更新する
     * 
     * @return view
     */


    public function update(ProductRequest $request) {
        
        //商品のデータを受け取る
        $inputs=$request->all();

        

        \DB::beginTransaction();

        try{
         //商品を登録
        $product =  Product::find($inputs ['id']);
         \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);

        }
       

        \Session::flash('err_msg','商品を登録しました');
        return redirect(route('index'));
        

    }

  /**
     * 商品編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function showEdit($id){
   
        $product = Product::find($id);
        
       
        if (is_null($product)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('index'));

        }

       return view('product.edit',
        ['product' => $product]);

   } 



      /**
     * 商品を更新する
     * 
     * @return view
     */


    public function exeUpdate(ProductRequest $request) {
        
        //商品のデータを受け取る
        $inputs=$request->all();


        \DB::beginTransaction();

        try{
         //商品を登録
         $product = Product::find($inputs['id']);
         $product->fill([
             'product_name' => $inputs['product_name'],
             'content' => $inputs['content'],
             'price' => $inputs['price'],             
         ]);
         $product->save();
         \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);

        }
       

        \Session::flash('err_msg','商品を更新しました');
        return redirect(route('index'));
        

    }


     /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function exeDelete($id){

        if (empty($id)) {
            \Session::flash('err_msg','データがありません。');
            return redirect(route('index'));

        }

        try{
            //商品を登録
            Product::destroy($id);
           } catch(\Throwable $e){
               abort(500);
   
           }

       
        
       
       
        \Session::flash('err_msg','削除しました。');
           return redirect(route('index'));
   } 


   }



