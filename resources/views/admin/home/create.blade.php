@extends('admin.layouts.app')

@section('title', 'Admin - Banner Create')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_banner_name").focus();
    };
    $(document).ready(function(){
        $('#txt_banner_name').focus(function(){
            $('.banner_error1').text('');
            $(this).css("border-color","#006cff");
        })
        $('#txt_banner_title').focus(function(){
            $('.banner_error2').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_banner_name").blur(function(){
            if($("#txt_banner_name").val()==""){
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

<div id='admin_banner_create'>
    <h3>新增橫幅</h3><br>
    <form action="" method="" id="formSetBanner" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <div class="upload_error" id="banner_upload_error"></div>
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
                        <input type="file" name="file_BannerImg" /> <!-- rename it -->
                    </div>
                </span>
            </div>
        </div><br><br>

        <img src="" alt="Banner Image Preview..." class="image_preview" style="display:none"><br><br>

        <div class="form-group">
            <label for="txt_banner_name" class="control-label">橫幅名稱:</label>
            <input type="text" name="bannerName" class="form-control" id="txt_banner_name" placeholder="請輸入橫幅名稱">
            <span class="banner_error1" style="color:red"></span><br>
        </div><br><br>

        <div class="form-group">
            <label for="txt_banner_title" class="control-label">橫幅標題:</label>
            <input type="text" name="bannerTitle" class="form-control" id="txt_banner_title" placeholder="請輸入橫幅標題"><br>
        </div><br><br>

        <input type="button" class="btn btn-primary btn-sm" id="btn_create_banner" value="送出">
        <input type="button" class="btn btn-primary btn-sm" id="btn_create_banner_back" value="取消" onclick="window.location.href='{{ route('admin.home.index') }}'">
    </form>
</div>
@endsection