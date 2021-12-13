@extends('products.side')

@section('title', 'Product')

@section('products_nav')
@if (isset($type))
    <li class="active">{{ $type }}</li>
@endif
@endsection

@section('products')
<div id="product_list_wrap" class="col-xs-12 col-md-10 col-sm-9">
    @if (isset($type))
    <h2>{{ $type }}</h2>
    @else
    <h2>產品清單</h2>
    @endif
    <div id="product_list" class="row">
      <ul class="nav">
        @foreach ($products as $product)
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
          <li id='li_product'>
            <a href='/product/{{ $product->product_type->name }}/{{ $product->name }}'>{{ $product->name }}</a><br>
            <a href='/product/{{ $product->product_type->name }}/{{ $product->name }}'>
            <img class="img_product" src='/uploads/images/product/{{ $product->image_name }}' width="150px" height="120px">
            </a>
          </li>
        </div>
        @endforeach
      </ul>
    </div>
</div>
@endsection