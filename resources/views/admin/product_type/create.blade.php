@extends('admin.layouts.app')

@section('title', 'Admin - Product Type Create')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_productType_name").focus();
    };
    $(document).ready(function(){
        $('#txt_productType_name').focus(function(){
            $('.user_error1').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_productType_name").blur(function(){
            if($("#txt_productType_name").val()==""){
                $('.user_error1').text('');
            }else if(rule1.test($(this).val())){
                $('.user_error1').text('');
            }else{
                $('.user_error1').text('格式錯誤，只能輸入英文、中文及符號" \' "、"-"、"_"');
                $(this).css("border-color","red");
            }
        })
    });
</script>

<div id='admin_productType_create'>
    <h3>新增產品分類</h3><br>
    <form id="formSetPorductType" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <label for="txt_productType_name" class="control-label">產品分類名稱:</label>
            <input type="text" name="txt_productType_name" class="form-control" id="txt_productType_name" placeholder="請輸入產品分類名稱">
            <span class="user_error1"></span>
        </div>
        <br><br>

        <input type="button" class="btn btn-primary btn-sm" id="btn_create_productType" value="送出">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.product_type.index') }}'">

    </form>
</div>

@endsection