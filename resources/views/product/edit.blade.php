@extends('layout')
@section('title', '商品編集')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()"  enctype="multipart/form-data">
          @csrf  
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="product_name">
                    商品名
                </label>
                <input
                    id="id"
                    name="product_name"
                    class="form-control"
                    value="{{ $product->product_name }}"
                    type="text"
                >
                @if ($errors->has('product_name'))
                    <div class="text-danger">
                        {{ $errors->first('product_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
            <label>メーカー名</label>
            <!--li><input placeholder="選択してください" type="text" name="company_name"></li--> 
            <select class="form-control" id="company_id" name="company_name"> 
                @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}
                </option>
                @endforeach

            </select>
                @if ($errors->has('company_name'))
                    <div class="text-danger">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="price">
                    価格
                </label>
                <input
                    id="id"
                    name="price"
                    class="form-control"
                    value="{{ $product->price }}"
                    type="text"
                >
                @if ($errors->has('price'))
                    <div class="text-danger">
                        {{ $errors->first('price') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="stock">
                    在庫数
                </label>
                <input
                    id="id"
                    name="stock"
                    class="form-control"
                    value="{{ $product->stock }}"
                    type="text"
                >
                @if ($errors->has('stock'))
                    <div class="text-danger">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    コメント
                </label>
                <textarea
                    id="id"
                    name="content"
                    class="form-control"
                    rows="4"
                >{{ $product->content }}</textarea>
                @if ($errors->has('content'))
                    <div class="text-danger">
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="image">
                    画像登録
                </label>
                <input type="file" class="form-control-file" name='img_path' id="id">
               
                @if ($errors->has('img_path'))
                    <div class="text-danger">
                        {{ $errors->first('img_path') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('index') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/common.js') }}"></script>

@endsection