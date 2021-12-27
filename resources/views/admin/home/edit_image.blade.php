@extends('admin.layouts.app')

@section('title', 'Admin - Banner Edit Image')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id="admin_banner_img_update">
    <h3>更新橫幅圖片</h3><br>
    <img src="/storage/uploads/images/banner/{{ $banner->image_name }}"><br><br>
    <form enctype="multipart/form-data" action="{{ route('admin.home.image.update', ['home' => $banner->id]) }}" method="POST" id="formUpdateBannerImg" class="form-inline" role="form">
        @method('PUT')
        @csrf
        <div class="form-group">
            <div class="input-group image-preview">
            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
            <span class="input-group-btn">
                <!-- image-preview-clear button -->
                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                <span class="glyphicon glyphicon-remove"></span> 清除
                </button>
                <!-- image-preview-input -->
                <div class="btn btn-default image-preview-input">
                <span class="glyphicon glyphicon-folder-open"></span>
                <span class="image-preview-input-title">選擇圖片</span>
                <input type="file" name="file_bannerImg_update"/> <!-- rename it -->
                </div>
            </span>
            </div>
        </div><br><br>

        <img src="" alt="Banner Image Preview..." class="image_preview" style="display:none"><br><br>

        <input type="submit" class="btn btn-primary btn-sm" value="上傳">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.home.edit', ['home' => $banner->id]) }}'">
    </form>
</div>
@endsection