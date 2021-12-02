@extends('layouts.app')

@section('title', 'Home')

@section('main')
      <!-- Banner -->
      <div id="banner_wrap" class="container">
        <div id="banner" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            @for ($i = 0; $i < $banners->count(); $i++)
              <li data-target="#banner" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : ''}}"></li>
            @endfor
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
          @foreach ($banners as $banner)
            <div class="item {{ $loop->first ? 'active' : ''}}">
                <img src="/uploads/images/banner/{{ $banner->image_name }}" alt="{{ $banner->name }}" title="{{ $banner->title }}">
            </div>
          @endforeach
          </div>
        </div>
      </div>
      <!-- end of Banner -->

      <!-- news -->
      <div id="news" class="container home text_style">
          <div id="newsBox">
              <h3>最新消息</h3>
              <table id="tb_news" class="table table-bordered">
                 <tr>
                     <th width=64%>標題</th>
                     <th width=36%>時間</th>
                 </tr>
                 @foreach ($homenews as $news)
                   <tr>
                    <td><a href="/news/{{ $news->id }}">{{ $news->title }}</a></td>
                    <td>{{ $news->created_at }}</td>
                   </tr>
                 @endforeach
              </table>
              <a href="/news" id="news_more" class="btn btn-primary btn-sm">more</a>
          </div>
      </div>
      <!-- end of news -->

      <!-- product -->
      <div id="product" class="container home text_style" >
          <div id="productBox">
              <h3>最新產品</h3>
              <hr id="productHr" style="border-color:#5A2626; border-width: 1px 0;">
              <div id="new_product" class="row">
                <ul class="nav">
                  @foreach ($products as $product)
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <li id='li_product'>
                      <a href='/product/{{ $product->product_type_id }}/{{ $product->name }}'>{{ $product->name }}</a><br>
                      <a href='/product/{{ $product->product_type_id }}/{{ $product->name }}'>
                      <img class="img_product" src='/uploads/images/product/{{ $product->image_name }}'>
                      </a>
                    </li>
                  </div>
                  @endforeach
                </ul>
              </div>
              <a href="/product" id="product_more" class="btn btn-primary btn-sm">more</a>
          </div>
      </div>
      <!-- end of product -->
@endsection