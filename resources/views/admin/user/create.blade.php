@extends('admin.layouts.app')

@section('title', 'Admin - User Create')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    window.onload = function() {
        document.getElementById("txt_user_name").focus();
    };
    $(document).ready(function(){
            $('#txt_user_name').focus(function(){
                $('.user_error1').text('');
                $(this).css("border-color","#006cff");
            })
            $('#txt_user_email').focus(function(){
                $('.user_error2').text('');
                $(this).css("border-color","#006cff");
            })

            $('#psw_user_password').focus(function(){
                $('.user_error3').text('');
                $('.user_error4').removeClass('glyphicon-remove-circle glyphicon-ok-circle');
                $(this).css("border-color","#006cff");
            })

            $('#psw_user_password2').focus(function(){
                $('.user_error4').text('');
                $(this).css("border-color","#006cff");
            })

        var rule1_1=/^[\u4e00-\u9fa5\w\-]+$/;
        var rule1_2 = /^[A-Za-z\-]+\s+[A-Za-z\-]+$/;
        var rule1_3 = /^[A-Za-z\-]+\s+[A-Za-z\-]+\s+[A-Za-z\-]+$/;
        $("#txt_user_name").blur(function(){
            if($("#txt_user_name").val()==""){
                $('.user_error1').text('');
            }else if(rule1_1.test($(this).val()) || rule1_2.test($(this).val()) || rule1_3.test($(this).val())){
                $('.user_error1').text('');
            }else {
                $('.user_error1').text('格式錯誤，只能輸入中英文名稱、數字及符號"-"、"_"');
                $(this).css("border-color","red");
            }
        })

        //var rule2=/^\w+$/;
        var rule2=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
        $("#txt_user_email").blur(function(){
            if($("#txt_user_email").val()==""){
                $('.user_error2').text('');
            }else if($("#txt_user_email").val().indexOf(' ')>=0){
                $('.user_error2').text('請勿輸入空格');
                $(this).css("border-color","red");
            }else if(rule2.test($(this).val())){
                $('.user_error2').text('');
            }else {
                //$('.user_error2').text('格式錯誤，只能允許輸入英文字母大小寫、數字及"_"');
                $('.user_error2').text('格式錯誤，請輸入正確的E-mail格式');
                $(this).css("border-color","red");
            }
        })

        var rule3=/^.[A-Za-z0-9]+$/;
        $("#psw_user_password").blur(function(){
            if($("#psw_user_password").val()==""){
                $('.user_error3').text('');
            }else if($("#psw_user_password").val().indexOf(' ')>=0){
                $('.user_error3').text('請勿輸入空格');
                $(this).css("border-color","red");
            }else if(rule3.test($(this).val())){
                $('.user_error3').text('');
            }else {
                $('.user_error3').text('格式錯誤，只能允許輸入英文字母大小寫及數字');
                $(this).css("border-color","red");
            }
        })

        $("#psw_user_password2").keyup(function(){
            if($("#psw_user_password").val()==""){
                $('.user_error4').removeClass('glyphicon-remove-circle glyphicon-ok-circle');
            }else if($("#psw_user_password").val()==$("#psw_user_password2").val()){
                $('.user_error4').removeClass('glyphicon-remove-circle');
                $('.user_error4').addClass('glyphicon-ok-circle');
                $('.user_error4').css("color","green");
            }else{
                $('.user_error4').removeClass('glyphicon-ok-circle');
                $('.user_error4').addClass('glyphicon-remove-circle');
                $('.user_error4').css("color","red");
            }
        })
    });
</script>


<div id='admin_user_create'>
    <h3>新增帳號</h3><br><br>
    <form id="formSetUser" class="form-horizontal" role="form">
        @csrf
        <div class="form-group">
            <label for="txt_user_name" class="col-sm-2 control-label">使用者名稱</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="txt_user_name" placeholder="請輸入名稱">
                <span class="user_error1"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="txt_user_email" class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="txt_user_email" placeholder="請輸入E-mail">
                <span class="user_error2"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="psw_user_password" class="col-sm-2 control-label">密碼</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="psw_user_password" placeholder="請輸入密碼">
                <span class="user_error3"></span>
            </div>
        </div>

        <div class="form-group">
            <label for="psw_user_password2" class="col-sm-2 control-label">確認密碼</label>
            <div class="col-sm-5">
                <input type="password" class="form-control" id="psw_user_password2" placeholder="請再輸入一次密碼">
            </div>
            <div class="col-sm-1">
                <span class="user_error4 glyphicon"></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
                <input type="button" class="btn btn-primary btn-sm" value="確定" id="btn_create_user">
                <input type="reset" class="btn btn-primary btn-sm" value="重新輸入">
                <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.user.index') }}'">
            </div>
        </div>
    </form>
</div>
@endsection