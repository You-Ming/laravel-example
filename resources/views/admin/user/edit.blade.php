@extends('admin.layouts.app')

@section('title', 'Admin - User Edit')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
@if (auth()->user()->email != 'admin' && auth()->user()->id != $user->id)
    <div class="modal fade" id="madal_update_user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">無權限觀看此畫面</h4>
                </div>
                <div class="modal-body">
                    <p>只有透過該帳號登入，才能對該帳號進行修改</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('admin.user.index') }}'">確定</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>$("#madal_update_user").modal();</script>
@else
    <script>
        window.onload = function() {
            document.getElementById("txt_user_name_update").focus();
        };
        $(document).ready(function(){
                $('#txt_user_name_update').focus(function(){
                    $('.user_error1').text('');
                    $(this).css("border-color","#006cff");
                })

                $('#psw_user_password_update').focus(function(){
                    $('.user_error3').text('');
                    $('.user_error4').removeClass('glyphicon-remove-circle glyphicon-ok-circle');
                    $(this).css("border-color","#006cff");
                })

                $('#psw_user_password2_update').focus(function(){
                    $('.user_error4').text('');
                    $(this).css("border-color","#006cff");
                })

            var rule1_1=/^[\u4e00-\u9fa5\w]+$/;
            var rule1_2 = /^[A-Za-z\-]+\s+[A-Za-z\-]+$/;
            var rule1_3 = /^[A-Za-z\-]+\s+[A-Za-z\-]+\s+[A-Za-z\-]+$/;
            $("#txt_user_name_update").blur(function(){
                if($("#txt_user_name_update").val()==""){
                    $('.user_error1').text('');
                }else if(rule1_1.test($(this).val()) || rule1_2.test($(this).val()) || rule1_3.test($(this).val())){
                    $('.user_error1').text('');
                }else {
                    $('.user_error1').text('格式錯誤，只能輸入中英文名稱、數字及"_"');
                    $(this).css("border-color","red");
                }
            })

            var rule3=/^.[A-Za-z0-9]+$/;
            $("#psw_user_password_update").blur(function(){
                if($("#psw_user_password_update").val()==""){
                    $('.user_error3').text('');
                }else if($("#psw_user_password_update").val().indexOf(' ')>=0){
                    $('.user_error3').text('請勿輸入空格');
                    $(this).css("border-color","red");
                }else if(rule3.test($(this).val())){
                    $('.user_error3').text('');
                }else {
                    $('.user_error3').text('格式錯誤，只能允許輸入英文字母大小寫及數字');
                    $(this).css("border-color","red");
                }
            })

            $("#psw_user_password2_update").keyup(function(){
                if($("#psw_user_password_update").val()==""){
                    $('.user_error4').removeClass('glyphicon-remove-circle glyphicon-ok-circle');
                }else if($("#psw_user_password_update").val()==$("#psw_user_password2_update").val()){
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

    <div id='admin_user_update'>
        <h3>修改帳號</h3><br><br>
        <form id="formUpdateUser" class="form-horizontal" role="form">
            @csrf
            <div class="form-group">
                <label for="txt_email_update" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-5">
                    <p class="form-control-static" id="txt_email_update">{{ $user->email }}</p>
                </div>
            </div>

            <div class="form-group">
                <label for="txt_user_name_update" class="col-sm-2 control-label">使用者名稱</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="txt_user_name_update" value="{{ $user->name }}" placeholder="請輸入新名稱">
                    <span class="user_error1"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="psw_user_password_update" class="col-sm-2 control-label">密碼</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="psw_user_password_update" placeholder="請輸入新密碼">
                    <span class="user_error3"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="psw_user_password2_update" class="col-sm-2 control-label">確認密碼</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="psw_user_password2_update" placeholder="請再輸入一次密碼">
                </div>
                <div class="col-sm-1">
                    <span class="user_error4 glyphicon"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-5">
                    <input type="button" class="btn btn-primary btn-sm" value="確定" id="btn_update_user" data-id="{{ $user->id }}">
                    <input type="reset" class="btn btn-primary btn-sm" value="重新輸入">
                    <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.user.index') }}'">
                </div>
            </div>
        </form>
    </div>
@endif
@endsection