@extends('admin.layouts.app')

@section('title', 'Admin - Product Edit')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function(){
        document.getElementById("txt_product_name_update").focus();
    };
    $(document).ready(function(){
        $('#txt_product_name_update').focus(function(){
            $('.product_error1').text('');
            $(this).css("border-color","#006cff");
        })
    
        var rule1 = /^[\u4e00-\u9fa5\w\-\']+(\s{1}[\u4e00-\u9fa5\w\-\']+)*$/;
        $("#txt_product_name_update").blur(function(){
            if($("#txt_product_name_update").val()==""){
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

<div id='admin_product_update'>
    <h3>修改產品</h3><br>
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
    <button class="btn btn-primary btn-sm" id="btn_update_product_img" onclick="window.location.href='{{ route('admin.product.image.edit', ['product' => $product->id]) }}'">更新產品圖片</button><br><br>
    <form id="formUpdatePproduct" class="form-inline" role="form">
        @csrf

        <div class="form-group">
            <label for="txt_product_img_name_update" class="control-label">圖片名稱:</label>
            <input type="text" class="form-control" id="txt_product_img_name_update" value="{{ $product->image_name }}" readonly>
        </div><br><br>

        <div class="form-group">
            <label for="txt_product_name_update" class="control-label">產品名稱:</label>
            <input type="text" name="txt_product_name_update" class="form-control" id="txt_product_name_update" value="{{ $product->name }}" placeholder="請輸入產品名稱">
            <span class="product_error1" style="color:red"></span><br>
        </div><br><br>

        <div class="form-group">
            <label for="sel_product_type_update" class="control-label">產品分類:</label>
            <select class="selectpicker" id="sel_product_type_update">
                @foreach ($types as $type)
                <option {{ $product->product_type->name == $type->name ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
                @endforeach
            </select>
        </div><br><br>

        <div class="form-group">
            <div id="product_spec_update">
                <label for="product_spec_update" class="control-label">產品規格:</label>
                <button type="button" class="btn btn-default" id="btn_add_product_spec">
                    <span class="glyphicon glyphicon-plus"></span>
                </button><br><br>
                @foreach (json_decode($product->specification) as $key => $value)
                <div id="sec_product_spec_update">
                    <input type="text" name="txt_product_spec_key_update" class="form-control" id="txt_product_spec_key_update" placeholder="請輸入規格名稱" value="{{ $key }}">
                    <input type="text" name="txt_product_spec_value_update" class="form-control" id="txt_product_spec_value_update" placeholder="請輸入規格" value="{{ $value }}">
                    <button type="button" class="btn btn-default" id="btn_del_product_spec">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </div>
                @endforeach
            </div>
        </div><br><br>

        <div class="form-group">
            <label for="textarea_update_product_desc" class="control-label">產品描述:</label>
            <textarea id="textarea_update_product_desc" name="textarea_update_product_desc">{{ $product->description }}</textarea><br>
        </div><br><br>

        <script>
            CKFinder.setupCKEditor();
            CKEDITOR.replace( 'textarea_update_product_desc', {width:1000,});
        </script>

        <input type="button" class="btn btn-primary btn-sm" id="btn_update_product" value="送出" data-id="{{ $product->id }}" data-name="{{ $product->name }}">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='/admin/product'">

    </form>
</div>

@endsection