<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <title>laravel demo - @yield('title')</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="shortcut icon" type="image/png" href="/images/Logo.png" />
  <link rel="stylesheet" href="/css/admin/admin.css"/>

  <script type="text/javascript"></script>
  <script src="/js/admin/admin.js"></script>

</head>

<body>
  <div class="wrap">
    <!-- header -->
    <div id="admin_wrap">
      <nav id="nav_header" class="navbar navbar-default" role="navigation">
        <div id="admin_header_wrap" class="container-fluid">
          <div id="admin_header" class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#admin_nav_list">
              <span class="sr-only">Toggle admin navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/admin">
              <img src="/images/Logo.png" alt="logo" width="40px" height="40px">
            </a>
          </div>
          <ul id="ul_header" class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle active" data-toggle="dropdown" data-target="#" href="#" id="dropdownMenu1" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                {{ auth()->user()->name }}
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li>
                  <a href="/admin/log_out" id="signin_link"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 登出</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- end of header -->



      <div id="admin_content_wrap" class="container-fluid navbar-default">
        <div class="row">
          <!-- admin side bar -->
          <div id="admin_nav_wrap" class="siderbar col-md-2 col-sm-3">
            <div id="admin_nav_list" class=" collapse navbar-collapse">
              <ul class="nav">
                <li><a href="/admin/home">首頁橫幅</a></li>
                <li><a href="/admin/about">關於我們</a></li>
                <li><a href="/admin/news">新聞</a></li>
                <li>
                  <a data-toggle="collapse" data-target="#sub_product" id="menu_product">產品
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" id="product_right_icon"></span>
                  </a>
                  <ul class="nav collapse" id="sub_product">
                    <li><a href="/admin/product">產品管理</a></li>
                    <li><a href="/admin/product_type">分類管理</a></li>
                  </ul>
                </li>
                <li><a href="/admin/contact">聯絡我們</a></li>
                <li><a href="/admin/user">帳號</a></li>
              </ul>
            </div>
          </div>
          <!-- end of side bar -->
          
          @yield('breadcrumb')

          <div id="admin_content" class="col-md-10 col-sm-9">

            @yield('main')

          </div>
        </div>
      </div>
    </div>

    <script src="/js/admin/bottom.js"></script>


  </div>
  <footer id="footer" class="footer container-fluid text-center">
    <div id="copyright" class="container">
      <p class="text-muted">Designed by YOU-MING HSU<br>Copyright © 2021. Website Demo</p>
    </div>
  </footer>
</body>

</html>