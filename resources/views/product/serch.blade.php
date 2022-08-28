@extends('layout')

@section('content')
<div style="margin-top:50px;">
<h1>検索結果</h1>
@if(isset($products))
<table class="table">
  <tr>
    <th>商品名</th><th>メーカー名</th>
  </tr>
  @foreach($products as $product)
    <tr>
      <td>{{$product_keyword->product_name}}</td><td>{{$product->company->company_name}}</td>
    </tr>
  @endforeach
</table>
@endif
@if(!empty($message))
<div class="alert alert-primary" role="alert">{{ $message}}</div>
@endif
</div>
@endsection
