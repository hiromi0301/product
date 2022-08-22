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
     * 商品一覧を表示する、検索結果一覧
     * 
     * @return view
     */
    public function index(Request $request){
   
        

       // $products = Product::with('company:id,name')->orderBy('id', 'asc')->paginate(20);
        $products = Product::with('company:id,company_name')->get();

       // dd($products);



       $keyword = $request->input('keyword');
       
       $query = Product::query();
    
       if(!empty($keyword)) {
           $query->where('product_name', 'LIKE', "%{$keyword}%")
               ->orWhere('company_name', 'LIKE', "%{$keyword}%");
       }

       $products = $query->get();

       //dd($products);

       //return view('index', compact('products', 'keyword'));
       
        return view('product.list',['products' => $products],compact('products','keyword'));
       
       
        
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
      //dd($inputs);
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

        $img = $request->img_path->getClientOriginalName();
       

        if (!is_null($img)) {

            $path = $request->img_path->storeAs('',$img,'public');
         
        }


       // dd($img);

    


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


        $product=new Product;

       //dd($inputs);

       //dd($request->img_path);
       $img = $request->img_path->getClientOriginalName();
      // $img = $request->file('image');

       
       if (!is_null($img)) {

           $path = $request->img_path->storeAs('',$img,'public');
         
        }


        \DB::beginTransaction();

        try{
         //商品を登録
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
            //var_dump($e);
            //exit;
            //abort(500);
            throw new \Exception($e->getMessage());

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


/**
     * 検索結果一覧
     * 
     * @return view
     */
    public function serch(Request $request){
   
        

        // $products = Product::with('company:id,name')->orderBy('id', 'asc')->paginate(20);
        // $products = Product::with('company:id,company_name')->get();
 
        // dd($products);

        $products=Product::getAll();
        $viewProducts=[
            'products'=>$products,
        ];
 
 
 
        $keyword = $request->input('keyword');
        
        $query = Product::query();
     
        if(!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('company_name', 'LIKE', "%{$keyword}%");
        }
 
        $products = $query->get();
 
        //dd($products);
 
        //return view('index', compact('products', 'keyword'));
        
         return view('product.serch',$viewProducts);
        
        
         
    } 
    


}



   


