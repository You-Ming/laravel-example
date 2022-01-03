<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>laravel demo - @yield('title')</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" type="image/png" href="/images/Logo.png"/>
        <link rel="stylesheet" href="/css/app.css"/>

        <script type="text/javascript"></script>
        <script src="/js/app.js"></script>
        
    </head>
    <body class="antialiased">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div id="header_wrap" class="container">
                <div id="header" class="grid">
                    <div id="nav" class="row">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="/">
                                <img src="/images/Logo.png" alt="logo" width="40px" height="40px">
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navtext">
                                <li>
                                    <a href="/about">關於我們</a>
                                </li>
                                <li>
                                    <a href="/news">新聞</a>
                                </li>
                                <li>
                                    <a href="/product">產品</a>
                                </li>
                                <li>
                                    <a href="/contact">聯絡我們</a>
                                </li>
                            </ul>
                            <ul id="headerSignin" class="nav navbar-nav navbar-right navtext">
                                <li>
                                    <a href="/sign_in" id="signin_link"><span class="glyphicon glyphicon-log-in"></span> 登入</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            @yield('main')
        </main>

        <footer id="footer" class="footer container-fluid text-center">
            <div id="copyright" class="container">
                <p class="text-muted">Designed by YOU-MING HSU<br>Copyright © 2021. Website Demo</p>
            </div>
        </footer>
    </body>
</html>
