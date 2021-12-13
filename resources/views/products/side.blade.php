@extends('layouts.app')

@section('main')
      <!-- product list -->
      <div id="product_wrap" class="container-fluid text_style">
        <div class="row">

          <div id="product_flip" class="visible-xs panel panel-default" aria-label="product flip">
            <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
          </div>

          <div id="product_nav" class="col-md-2 col-sm-3 toggle_nav">
            <ul class="nav navbar-default">
              <li><a href='/product'>產品清單</a></li>

              @foreach ($product_types as $product_type)
              <li><a href='/product/{{ $product_type->name }}'>{{ $product_type->name }}</a></li>
              @endforeach

            </ul>
          </div>

          <div class="col-md-10 col-sm-9">
            <ol class="breadcrumb nav_list" id="product_nav_list">
              <li><a href="/"><span class="glyphicon glyphicon-home"></span> 首頁</a></li>
              <li><a href="/product">產品</a></li>

              @yield('products_nav')
              
            </ol>
          </div>

          @yield('products')

        </div>
      </div>
      <!-- end of product list -->
@endsection