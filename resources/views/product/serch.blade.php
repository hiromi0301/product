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
    <li><input placeholder="上限値を入力" type="text" name="price_upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="price_lower"></li>
  </div>
  
  <div class="form-group">
    <label>在庫数</label>
    <li><input placeholder="上限値を入力" type="text" name="stock_upper"></li>
    <li><input placeholder="下限値を入力" type="text" name="stock_lower"></li>

  <div class="form-group">
    <label>商品名</label>
    <li><input placeholder="商品名を入力" type="text" name="product_name"></li>

  <div class="form-group">
    <label>メーカー名</label>
    <select class="form-control" id="company_id" name="company_id"> 
    @foreach($companies as $company)
                        if (isset($company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
    @endforeach

    </select>
  </div>

  <button type="submit" class="btn serch-btn col-md-5">検索</button>
</form>
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
@endif
<div style="margin-top:50px;">

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
