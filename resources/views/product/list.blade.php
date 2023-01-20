@extends('layout')
@section('title','商品一覧')
@section('content')
<div class="row">
  <div class="col-md-12 col-md-offset-2">
    
      @if (session('message'))
        <p class="text-danger">
            {{ session('message')}}
        </p>
      @endif  

      <p>検索条件を入力してください</p>
<form action="{{ url('/serch')}}" method="get">
  {{ csrf_field()}}
  {{method_field('get')}}

  <div class="form-group">
    <label>商品名</label>
    <input type="serch" class="form-control col-md-5" placeholder="検索したい商品名を入力してください" name="product_name">
  </div>
  <div class="form-group">
    <label>メーカー名</label>
    <select class="form-control col-md-5" name="company_id">
    <option disabled selected>未選択</option>
    <option value="1" name="company_id">A</option>
    <option value="2" name="company_id">B</option>
    <option value="3" name="company_id">C</option>
    <option value="4" name="company_id">D</option>
    <option value="5" name="company_id">E</option>
     </select>
   </div>

 <button type="submit" class="btn btn-primary col-md-5">検索</button>
</form>
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
@endif
<div style="margin-top:50px;">



<h2>商品一覧</h2>

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
              <form method="POST" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button type="submit" class="btn btn-primary" onclick=>削除</button></td>
          </tr>
          @endforeach
      </table>
  </div>
</div>

<script>
function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
    }
</script>

@endsection
