@extends('layouts.app')

@section('title', 'Contact')

@section('main')
<script>
    window.onload = function() {
        document.getElementById("guestName").focus();
    };
    $(document).ready(function(){
            $('#guestName').focus(function(){
                $('#guestName_error').text('');
                $(this).css("border-color","#006cff")
            })
            $('#guestEmail').focus(function(){
                $('#guestEmail_error').text('');
                $(this).css("border-color","#006cff")
            })
            $('#guestTitle').focus(function(){
                $('#guestTitle_error').text('');
                $(this).css("border-color","#006cff")
            })
            $('#guestContent').focus(function(){
                $('#guestContent_error').text('');
                $(this).css("border-color","#006cff")
            })

        var rule1=/.{0,50}/;
        $("#guestName").blur(function(){
            if(rule1.test($(this).val())){
                $('#guestName_error').text('')
            }else {
                $('#guestName_error').text('格式錯誤')
                $(this).css("border-color","red")
            }
        })
        var rule2=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
        $("#guestEmail").blur(function(){
            if($("#guestEmail").val().indexOf(' ')>=0){
                $('#guestEmail_error').text('請勿輸入空格')
                $(this).css("border-color","red")
            }else if(rule2.test($(this).val())){
                $('#guestEmail_error').text('')
            }else{
                $('#guestEmail_error').text('格式錯誤')
                $(this).css("border-color","red")
            }
        })

        var rule3=/.+/;
            $("#guestContent").blur(function(){
                if(rule3.test($(this).val())){
                    $('#guestContent_error').text('')
                }else{
                    $('#guestContent_error').text('格式錯誤')
                    $(this).css("border-color","red")
                }
            })
      })
      function sendMessage(e){
        e.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.recaptcha_site_key') }}').then(function(token) {
                if($('#guestName_error').text()=="" && $('#guestEmail_error').text()=="" && $('#guestContent_error').text()==""){
                    console.log(token)
                    var guestName = $('#guestName').val();
                    var guestEmail = $('#guestEmail').val();
                    var guestTitle = $('#guestTitle').val();
                    var guestContent = $('#guestContent').val();
                    var recaptchaToken = token;

                    if(guestEmail!="" && guestName!="" && guestContent!="" && guestTitle!=""){
                        if(confirm("您確定要留言嗎?")){
                            $.ajax({
                                url:"ajax/contact",
                                data:"&guestName="+guestName+"&guestEmail="+guestEmail+"&guestTitle="+guestTitle+"&guestContent="+guestContent+"&recaptchaToken="+recaptchaToken,
                                type:"POST",
                                datatype:'json',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                error:function(err)
                                {
                                    if(err.status == 422){
                                        $.each(err.responseJSON.errors, function (key, value) {
                                            $("#" + key).next().html(value[0]);
                                        });
                                    }
                                    alert("留言失敗");
                                },
                                success:function(msg)
                                {
                                    alert(msg);
                                    $(location).attr("href","/");
                                }
                            });
                        }
                    }
                    else{
                        alert("請輸入姓名、信箱、主旨及內容");
                    }
                }
                else{
                    alert("格式錯誤,請重新輸入");
                }
            });
        });
    };

</script>


<div id="contact" class="container text_style">
    <h1 id="lb_contact">聯絡我們</h1>
    <div id = "contact_Box">
        <form method="" action="" id="contact_form" class="form-horizontal" role="form">
            @csrf
            <div class="form-group">
                <label for="guestName" class="col-sm-2 control-label">訪客姓名</label>
                <div class="col-sm-10">
                    <input type="text" name="guestName" id="guestName" class="form-control" placeholder="姓名"/>
                    <span id="guestName_error" class="error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="guestEmail" class="col-sm-2 control-label">訪客信箱</label>
                <div class="col-sm-10">
                    <input type="text" name="guestEmail" id="guestEmail" class="form-control" placeholder="信箱"/>
                    <span id="guestEmail_error" class="error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="guestTitle" class="col-sm-2 control-label">留言主旨</label>
                <div class="col-sm-10">
                    <input type="text" name="guestTitle" id="guestTitle" class="form-control" placeholder="主旨"/>
                    <span id="guestTitle_error" class="error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <label for="guestContent" class="col-sm-2 control-label">留言內容</label>
                <div class="col-sm-10">
                    <textarea name="guestContent" id="guestContent" class="form-control" placeholder="內容" rows="15" cols="30"></textarea>
                    <span id="guestContent_error" class="error text-danger"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="recaptchaToken" id="recaptchaToken">
                    <span class="error text-danger"></span>
                    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha_site_key') }}"></script>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="button" class="btn btn-default" value="送出" id="btn_sendMessage" onCLick="sendMessage(event);"/><span class="errorMessage" id="postError"></span>
                  <input type="reset" class="btn btn-default" value="重新輸入">
                  <input type="button" class="btn btn-default" value="返回主頁" onclick="window.location.href='/'">
                </div>
            </div>
        </form>
    </div>
</div>
<!--end of contact form-->
@endsection