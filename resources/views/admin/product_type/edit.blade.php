@extends('admin.layouts.app')

@section('title', 'Admin - Product Type Edit')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_productType_name_update").focus();
    };
    $(document).ready(function(){
        $('#txt_productType_name_update').focus(function(){
            $('.user_error1').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_productType_name_update").blur(function(){
            if($("#txt_productType_name_update").val()==""){
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

<div id='admin_productType_update'>
    <h3>修改產品分類</h3><br>
    <form id="formUpdatePorductType" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <label for="txt_productType_name_update" class="control-label">產品分類名稱:</label>
            <input type="text" name="txt_productType_name_update" class="form-control" id="txt_productType_name_update" placeholder="請輸入產品分類名稱" value="{{ $product_type->name }}">
            <span class="user_error1"></span>
        </div>
        <br><br>

        <input type="button" class="btn btn-primary btn-sm" id="btn_update_productType" value="送出" data-id="{{ $product_type->id }}">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.product_type.index') }}'">
    </form>
</div>
@endsection