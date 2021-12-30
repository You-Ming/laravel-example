@extends('admin.layouts.app')

@section('title', 'Admin - Product Edit Image')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id="admin_product_img_update">
    <h3>更新產品圖片</h3><br>
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->has('danger'))
        <div class="alert alert-danger alert-dismissible fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('danger') }}
        </div>
    @endif
    <img src="/storage/uploads/images/product/{{ $product->image_name }}"><br><br>
    <form enctype="multipart/form-data" action="{{ route('admin.product.image.update', ['product' => $product->id]) }}" method="POST" id="formUpdateProductImg" class="form-inline" role="form">
        @method('PUT')
        @csrf
        <div class="form-group">
            <div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled">
                <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> 清除
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">選擇圖片</span>
                        <input type="file" name="file_productImg_update" /> <!-- rename it -->
                    </div>
                </span>
            </div>
        </div><br><br>

        <img src="" alt="Banner Image Preview..." class="image_preview" style="display:none"><br><br>

        <input type="submit" class="btn btn-primary btn-sm" value="上傳">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.product.edit', ['product' => $product->id]) }}'">
    </form>
</div>

@endsection