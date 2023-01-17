<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;

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
   
    
        $products = Product::all();

        return view ("product.list",['products' => $products]);

    
       
        
                             } 

    /**
     * 商品検索結果一覧
     * 
     * @return view
     */
    public function serch(Request $request){
   

        $products = Product::getList($request);
        
        return view('product.serch', ['products' => $products]);
    
       
        
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


    public function create(Request $request) {
        
        
        return   view('product.form');
                                              }


    /**
     * 商品を登録する
     * 
     * @return view
     */


    public function store(ProductRequest $request) {
        
        //商品のデータを受け取る
        $inputs = $request->all();
      
        $product = new Product;

        $img = $request->img_path->getClientOriginalName();

        if (!is_null($img)) {

            $path = $request->img_path->storeAs('',$img,'public');
         
                             }

        //\DB::beginTransaction();

        //try{
            //商品を登録
            //Product::create([
            //'img_path' => $path,
            //'company_id' => $inputs['company_id'],
            //'product_name' => $inputs['product_name'],
            //'price' => $inputs['price'],
            //'stock' => $inputs['stock'],
            //'content' => $inputs['content'],
                              //]);

        //\DB::commit();
            //} catch(\Throwable $e){
            //\DB::rollback();
            //abort(500);

                                    //}
       

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
        $inputs = $request->all();


        $product = new Product;

        $img = $request->img_path->getClientOriginalName();
      
        if (!is_null($img)) {

            $path = $request->img_path->storeAs('',$img,'public');
         
                             }


        //\DB::beginTransaction();

        //try{
            //商品を登録
            //$product = Product::find($inputs['id']);
            //$product->fill([
                //'product_name' => $inputs['product_name'],
                //'content' => $inputs['content'],
                //'price' => $inputs['price'],    
                //'stock' => $inputs['stock'],
                //'company_id' => $inputs['company_id'],
                //'img_path' => $path,
                      
                            //]);
            //$product->save();
            //\DB::commit();
            
            //} catch(\Throwable $e){
                //\DB::rollback();
                //throw new \Exception($e->getMessage());

                                   //}
            \Session::flash('err_msg','商品を更新しました');
            $products = Product::getUpdate($request);
            return redirect(route('index'));
        

                                                    }


     /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function delete($id){

        if (empty($id)) {
        \Session::flash('err_msg','データがありません。');
        return redirect(route('index'));

                        }
        
        //\DB::beginTransaction();
        //try{
            //DB::beginTransaction();
            //商品を登録
            //Product::destroy($id);
            //DB::commit();

            //}catch(\Throwable $e){
                //abort(500);
   
                                 //}

            \Session::flash('err_msg','削除しました。');

            $products = Product::getDelete($id);
            return redirect(route('index'));
                                                } 

 
       
} 
    





   


