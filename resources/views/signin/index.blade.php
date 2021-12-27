<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>laravel demo - Sign in</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="/images/Logo.png"/>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/css/logo-nav.css">
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/styles.css">

        <script type="text/javascript"></script>
        <!-- jQuery -->
        <script src="/js/jquery.js"></script>
        <script src="/js/jquery.crypt.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="/js/bootstrap.min.js"></script>
        <script>
            window.onload = function() {
                document.getElementById("sign_in_username").focus();
            };
            function Submit(){
                if (event.keyCode == 13) {
                    $("#btn_SignIn").click();
                }
            }
            function SignIn(){
                var username = $('#sign_in_username').val();
                var password = $().crypt({method:"sha1",source:$("#sign_in_password").val()});
                if(username!="" && password!=""){
                $.ajax({
                    url:"ajax/signin",
                    data:"&email="+username+"&password="+password,
                    type:"POST",
                    datatype:'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    error:function(errors)
                    {
                        console.log(errors);
                        alert("錯誤");
                    },
                    success:function(msg)
                    {
                        console.log(msg);
                        if(msg == "success"){
                            //alert("登入成功");
                            $("#formSignIn").hide();
                            $("#SignInMessage").text("登入成功");
                            $(location).attr("href","/admin");
                        }
                        else if(msg == "passwordError"){
                            alert("密碼錯誤");
                            document.getElementById("sign_in_password").select();
                        }
                        else if(msg == "notfound"){
                            alert("此帳號不存在");
                            document.getElementById("sign_in_username").select();
                        }
                        else{
                            alert("登入失敗");
                            document.getElementById("sign_in_username").select();
                        }
                    }
                });
                }
                else{
                    alert("請輸入帳號及密碼");
                }
            };
        </script>
    </head>
    <body>
        <div id="signin_block" class="container text_style">
            <form method="" action="" id="formSignIn" class="form-signin" role="form" onkeypress="Submit()">
                @csrf
                <h2 class="form-signin-heading">管理者登入</h2>
                <label for="sign_in_username" class="sr-only">Username:</label>
                <input type="text" name="username" id="sign_in_username" class="form-control" placeholder="帳號"/><span class='error1'></span>
                <label for="sign_in_password" class="sr-only">Password:</label>
                <input type="password" name="password" id="sign_in_password" class="form-control" placeholder="密碼"/><span class='error1'></span>
                <input type="button" value="登入" id="btn_SignIn" class="btn btn-primary btn-block" onclick="SignIn();"/>
                <input type="button" value="返回" class="btn btn-primary btn-block" onclick="window.location.href='/'">
            </form>
            <p id="SignInMessage"></p>
        </div>
    </body>
</html>
