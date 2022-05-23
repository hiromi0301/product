@extends('layout')
@section('title','商品詳細')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h2>{{ $product->product_name }}</h2>
      <p>商品画像</P>
      <p>メーカー名{{ $product->company->company_name }}</P>
      <p>価格{{ $product->price }}</P>
      <p>在庫数{{ $product->stock }}</p>
      <p>コメント{{ $product->content }}</p>
    
  </div>
</div>

@endsection