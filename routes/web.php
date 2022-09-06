<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//①ルーティング作成（登録画面表示・ブログ登録）
//②コントローラー作成（登録画面表示）
//③登録画面のBladeを表示（CRSF対策）
//④コントローラー作成（ブログ登録）
//⑤バリデーション作成
//⑥エラー処理


//商品一覧画面を表示
Route::get('/index', [ProductController::class,'index'])->name('index');


//商品登録画面を表示
//Route::get('/product/create', 'ProductController@showCreate')->name('create');
Route::get('/create', [ProductController::class, 'create'])->name('create');

//商品登録
Route::post('/store', [ProductController::class, 'store'])->name('store');

//商品詳細画面を表示
Route::get('/product/{id}', [ProductController::class,'detail'])->name('detail');

//商品編集画面を表示
Route::get('/product/edit/{id}', 'ProductController@edit')->name('edit');
Route::post('/product/update','ProductController@update')->name('update');

//商品削除
Route::post('/product/delete/{id}','ProductController@exeDelete')->name('delete');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//ログイン機能の実装
Route::get('/welcome','HomeController@welcome')->name('welcome');

//検索結果を表示する
Route::get('/serch',[ProductController::class,'serch'])->name('serch');