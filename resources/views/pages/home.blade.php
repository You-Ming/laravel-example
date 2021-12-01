@extends('layouts.app')

@section('title', 'Home')

@section('main')
      <!-- Banner -->
      <div id="banner_wrap" class="container">
        <div id="banner" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            @for ($i = 0; $i < $banners->count(); $i++)
                @if($i == 0)
                    <li data-target="#banner" data-slide-to="{{ $i }}" class="active"></li>
                @else
                    <li data-target="#banner" data-slide-to="{{ $i }}" class=""></li>
                @endif
            @endfor
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
          @foreach ($banners as $banner)
            @if ($loop->first)
                <div class="item active">
            @else
                <div class="item">
            @endif
                <img src="/uploads/images/banner/{{ $banner->image_name }}" alt="{{ $banner->name }}" title="{{ $banner->title }}">
            </div>
          @endforeach
          </div>
        </div>
      </div>
      <!-- end of Banner -->
{{--
      <!-- news -->
      <div id="news" class="container home text_style">
          <div id="newsBox">
              <h3>最新消息</h3>
              <table id="tb_news" class="table table-bordered">
                 <tr>
                     <th width=64%>標題</th>
                     <th width=36%>時間</th>
                 </tr>
<?php foreach ($homenews as $news):?>
                  <tr>
                    <td><a href="/news/<?php echo $news['newsID'] ?>"><?php echo $news['newsTitle'] ?></a></td>
                    <td><?php echo $news['newsTime']?></td>
                  </tr>
<?php endforeach ?>
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
<?php foreach ($homeproduct as $product): ?>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                    <li id='li_product'>
                      <a href='/product/<?php echo $product['productType']?>/<?php echo $product['productName'] ?>'><?php echo $product['productName'] ?></a><br>
                      <a href='/product/<?php echo $product['productType']?>/<?php echo $product['productName'] ?>'>
                      <img class="img_product" src='/uploads/images/product/<?php echo $product['productImgName'] ?>'>
                      </a>
                    </li>
                  </div>
<?php endforeach?>
                </ul>
              </div>
              <a href="/product" id="product_more" class="btn btn-primary btn-sm">more</a>
          </div>
      </div>
      <!-- end of product -->
    --}}
@endsection