@extends('admin.layouts.app')

@section('title', 'Admin - Banner Edit')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_banner_name_update").focus();
    };
    $(document).ready(function(){
        $('#txt_banner_name_update').focus(function(){
            $('.banner_error1').text('');
            $(this).css("border-color","#006cff");
        })
        $('#txt_banner_title_update').focus(function(){
            $('.banner_error2').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_banner_name_update").blur(function(){
            if($("#txt_banner_name_update").val()==""){
                $('.banner_error1').text('');
            }else if(rule1.test($(this).val())){
                $('.banner_error1').text('');
            }else{
                $('.banner_error1').text('格式錯誤，只能輸入英文、中文及符號" \' "、"-"、"_"');
                $(this).css("border-color","red");
            }
        })
    
    });
</script>

<div id='admin_banner_update'>
    <h3>修改橫幅</h3><br>
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
    <img src="/storage/uploads/images/banner/{{ $banner->image_name }}"><br><br>
    <button class="btn btn-primary btn-sm" id="btn_update_product_img" onclick="window.location.href='{{ route('admin.home.image.edit', ['home' => $banner->id]) }}'">更新橫幅圖片</button><br><br>
    <form action="" method="" id="formUpdateBanner" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <label for="txt_banner_img_name" class="control-label">圖片名稱:</label>
            <input type="text" class="form-control" id="txt_banner_img_name" value="{{ $banner->image_name }}" readonly>
        </div><br><br>

        <div class="form-group">
            <label for="txt_banner_name_update" class="control-label">橫幅名稱:</label>
            <input type="text" name="txt_banner_name_update" class="form-control" id="txt_banner_name_update" placeholder="請輸入橫幅名稱" value="{{ $banner->name }}">
            <span class="banner_error1" style="color:red"></span><br>
        </div><br><br>

        <div class="form-group">
            <label for="txt_banner_title_update" class="control-label">橫幅標題:</label>
            <input type="text" name="txt_banner_title_update" class="form-control" id="txt_banner_title_update" placeholder="請輸入橫幅標題" value="{{ $banner->title }}"><br>
        </div><br><br>

        <input type="button" class="btn btn-primary btn-sm" id="btn_update_banner" value="送出" data-id="{{ $banner->id }}" data-name="{{ $banner->name }}">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='/admin/home'">
    </form>
</div>

@endsection