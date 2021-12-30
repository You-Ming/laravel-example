@extends('admin.layouts.app')

@section('title', 'Admin - Product Search')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    $(function(){
      $("#txt_search_product").keypress(function(){
        var key = event.keyCode;
        if(key == 13){
          $("#btn_search_product").click();
        }
      })
    });
    
</script>

<div id='admin_product'>
    <h3>產品管理</h3>
    <div class="form-group">
        <div class="input-group search-group">
            <input type="text" class="form-control input-search" id="txt_search_product" placeholder="請輸入關鍵字">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default image-preview-input" id="btn_search_product">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div><br>
    @if (count($products) === 0)
        <h4>查詢不到有關 「{{ $query }}」的結果</h4>
    @else
        <h4>查詢 「{{ $query }}」 的結果如下
        </h4><br>

        <table id='tb_admin_product' class="table table-bordered">
            <tr>
                <th width="30%">產品名稱</th>
                <th width="30%">產品分類</th>
                <th width="20%">產品圖片</th>
                <th width="20%">修改/刪除</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->product_type->name }}
                </td>
                <td><img src="/storage/uploads/images/product/{{ $product->image_name }}" class="img_admin_product">
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ route('admin.product.edit', ['product' => $product->id]) }}'">
                        <span class="glyphicon glyphicon-pencil"></span> <span class="btn_admin">修改</span>
                    </button>
                    <button class="btn btn-danger btn-sm" data-toggle="confirmation_product" data-title="確定要刪除嗎?" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-singleton="true">
                        <span class="glyphicon glyphicon-remove"></span> <span class="btn_admin">刪除</span>
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="admin_page_link" align="center">
            <ul class="pagination">
                {{ $products->links() }}
            </ul>
        </div>
    @endif
    <div align="center">
        <button type="button" class="btn btn-primary" onclick="window.location.href='/admin/product'">返回產品列表</button>
    </div>
</div>

@endsection