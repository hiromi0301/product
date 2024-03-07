@extends('layout')

@section('content')
<div style="margin-top:50px;">
<h1>検索結果</h1>
@if(isset($products))

<p>検索条件を入力してください</p>
<form action="{{ url('/serch')}}" method="get">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group">
    <label>価格</label>
    <li><input placeholder="上限値を入力" type="text" name="upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="lower"></li>
  </div>
  
  <div class="form-group">
    <label>在庫数</label>
    <li><input placeholder="上限値を入力" type="text" name="upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="lower"></li>

  <div class="form-group">
    <label>商品名</label>
    <li><input placeholder="上限値を入力" type="text" name="upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="lower"></li>

  <div class="form-group">
    <label>メーカー名</label>
    <li><input placeholder="上限値を入力" type="text" name="upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="lower"></li>  

  </div>

      <table class="table table-striped">
          <tr>
              <th>商品番号</th>
              <th>商品画像</th>
              <th>商品名</th>
              <th>価格</th>
              <th>在庫数</th>
              <th>メーカー名</th>
              <th></th>
              <th></th>
              
              
              
          </tr>
          @foreach( $products as $product )
          
       
          <tr>
              <td>{{ $product->id }}</td>
              <td><img src="{{ asset('storage/'.$product->img_path) }}" width="100px"></td>
              <td><a href="/product/{{ $product->id }}">{{ $product->product_name }}</a></td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->stock }}</td>
              <td>{{ $product->company->company_name }}</td>
              <td><button type="button" class="btn btn-primary" onclick="location.href='/product/edit/{{ $product->id }}'">編集</button></td>
              <form method="POST" action="{{ route('delete',$product->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
          </tr>
          @endforeach
      </table>
@endif
@if(!empty($message))
<div class="alert alert-primary" role="alert">{{ $message}}</div>
@endif
</div>
@endsection
