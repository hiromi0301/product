@extends('layout')
@section('title','商品一覧')
@section('content')
<div class="row">
  <div class="col-md-12 col-md-offset-2">
    
      @if (session('err_msg'))
        <p class="text-danger">
            {{ session('err_msg')}}
        </p>
      @endif  

      <p>検索条件を入力してください</p>
<form id="serch-form" action="{{ url('/serch')}}" method="get">
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
    <li><input placeholder="商品名を入力" type="text" name="product_name"></li>

  <div class="form-group">
    <label>メーカー名</label>
   <!--li><input placeholder="選択してください" type="text" name="company_name"></li--> 
    <select class="form-control" id="company_id" name="company_name"> 
    @foreach($companies as $company)
                        if (isset($company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach

    </select>
    
  </div>

 <button type="submit" class="btn serch-btn  col-md-5">検索</button>
</form>
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
@endif
<div style="margin-top:50px;">



<h2>商品一覧</h2> 
      <table class="tablesorter" id="sort_table">
        <thead>    
        <tr>
              <th scope="col">@sortablelink('id','商品番号')</th>
              <th scope="col">@sortablelink('img_path','商品画像')</th>
              <th scope="col">@sortablelink('name','商品名')</th>
              <th scope="col">@sortablelink('price','価格')</th>
              <th scope="col">@sortablelink('stock','在庫数')</th>
              <th scope="col">@sortablelink('company_name','メーカー名')</th>
              <th></th>
              <th></th>
              
              
              
        </tr>
          @foreach( $products as $product )
        </thead>

        <tbody>
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
              <td><button type="submit" class="btn data-delete" onclick=>削除</button></td>
          </tr>
            @endforeach
        </tbody>
      </table>
  </div>
</div>

<script type="text/javascript" 
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.1/js/jquery.tablesorter.min.js">

$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN':'{{ csrf_token() }}'
  }
});

  $(function(){
    $('.serch-btn').on('click',function(e){
      e.preventDefault();
        var clickEle = $(this)
        let serchData = $('#serch-form').serialize();
        
        $.ajax({
          type:'get',
          url:'serch',
          dataType:'html',
          data:serchData,
        }).done(function(data){
            let newTable = $(data).find('#serch-data')
            return redirect(route('serch')); 
      })
    })    
      
  $(function(){
    e.preventDefault();
    $('.btn-primary').on('click',function(){
      var deleteConfirm = confirm('削除してよろしいですか？');
      if(deleteConfirm == true){
        var clickEle = $(this)
        var productID =clickEle.attr('data-delete');
        
        $.ajax({
          type:'POST',
          url:'/product/delete/'+productID,
          dataType:'html',
          data:{'id':productID},

        }).done(function(data){
          clickEle.parents('tr').remove();
        })
      }
    })
  

      
  }else{
        (function(){
          e.preventDefault()
        });
      };
    });

  });

//function checkDelete(){
  //  if(window.confirm('削除してよろしいですか？')){
    //    return true;
   // } else {
     //   return false;
  //  }
   // }
</script>

@endsection
