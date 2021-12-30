@extends('admin.layouts.app')

@section('title', 'Admin - Product Create')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_product_name").focus();
    };
    $(document).ready(function(){
        $('#txt_product_name').focus(function(){
            $('.product_error1').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_product_name").blur(function(){
            if($("#txt_product_name").val()==""){
                $('.product_error1').text('');
            }else if(rule1.test($(this).val())){
                $('.product_error1').text('');
            }else{
                $('.product_error1').text('格式錯誤，只能輸入英文、中文及符號" \' "、"-"、"_"');
                $(this).css("border-color","red");
            }
        })
    });
</script>
<script src="/asset/ckeditor/ckeditor.js"></script>
<script src="/asset/ckfinder/ckfinder.js"></script>

<div id='admin_product_create'>
    <h3>新增產品</h3><br>
    <form id="formSetPproduct" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <div class="upload_error" id="product_upload_error"></div>
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
                        <input type="file" name="file_productImg" id="file_productImg" /> <!-- rename it -->
                    </div>
                </span>
            </div>
        </div><br><br>

        <img src="" alt="Product Image Preview..." class="image_preview" style="display:none"><br><br>

        <div class="form-group">
            <label for="txt_product_name" class="control-label">產品名稱:</label>
            <input type="text" name="productName" class="form-control" id="txt_product_name" placeholder="請輸入產品名稱">
            <span class="product_error1" style="color:red"></span><br>
        </div><br><br>

        <div class="form-group">
            <label for="sel_product_type" class="control-label">產品分類:</label>
            <select class="selectpicker" name="productType" id="sel_product_type">
                @foreach ($types as $type)
                <option>
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div><br><br>

        <div class="form-group">
            <div id="product_spec">
                <label for="textarea_set_product_spec" class="control-label">產品規格:</label>
                <button type="button" class="btn btn-default" id="btn_set_product_spec">
                    <span class="glyphicon glyphicon-plus"></span>
                </button><br><br>
                <div id="sec_product_spec">
                    <input type="text" name="txt_product_spec_key" class="form-control" id="txt_product_spec_key" placeholder="請輸入規格名稱">
                    <input type="text" name="txt_product_spec_value" class="form-control" id="txt_product_spec_value" placeholder="請輸入規格">
                    <button type="button" class="btn btn-default" id="btn_remove_product_spec">
                    <span class="glyphicon glyphicon-minus"></span></button>
                </div>
            </div>
        </div><br>

        <div class="form-group">
            <label for="textarea_set_product_desc" class="control-label">產品描述:</label>
            <textarea id="textarea_set_product_desc" name="textarea_set_product_desc"></textarea><br>
        </div><br><br>

        <script>
            CKFinder.setupCKEditor();
            CKEDITOR.replace( 'textarea_set_product_desc', {width:1000,});
        </script>

        <input type="button" class="btn btn-primary btn-sm" id="btn_create_product" value="送出">
        <input type="button" class="btn btn-primary btn-sm" id="btn_create_product_back" value="取消" onclick="window.location.href='{{ route('admin.product.index') }}'">
    </form>
</div>

@endsection