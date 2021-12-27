@extends('products.side')

@section('title', 'Product - '.$product->name)

@section('products_nav')
<li><a href="/product/{{ $type }}">{{ $type }}</a></li>
<li class="active">{{ $product->name }}</li>
@endsection

@section('products')
    <div id="product_view_wrap" class="col-md-10 col-sm-9">
        <div id="product_view">
        <h1>{{ $product->name }}</h1>
        <div class="row">
            <div class="col-sm-7 col-md-5">
            <img class="img_product_view" src='/storage/uploads/images/product/{{ $product->image_name }}'>
            </div>

            <div class="col-sm-5">
            <h4>產品規格:</h4>
            @isset($product_spec)
                @foreach ($product_spec as $key => $value)
                <p>{{ $key.' : '.$value }}</p>
                @endforeach
            @endisset
            </div>

            <div class="col-xs-8">
            <h4>產品描述:</h4>
            <p>{{ $product->description }}</p>
            </div>
        </div><br>
        <input type='button' class="btn btn-primary btn-sm" onclick="history.back()" value='返回'>
        </div>
    </div>
@endsection