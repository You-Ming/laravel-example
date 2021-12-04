@extends('layouts.app')

@section('title', 'About')

@section('main')
<div id="about_wrap" class="container-fluid text_style">
    <div class="row">
      <div id="about_flip" class="visible-xs panel panel-default" aria-label="about flip">
        <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
      </div>
        <div id="about_nav" class="col-md-2 col-sm-3 toggle_nav">
          <div class="sidebar-nav">
                <ul class="nav navbar-default">
                    @foreach ($abouts as $about)
                    <li>
                        <a href="/about/{{ $about->title }}">{{ $about->title }}</a>
                    </li>
                    @endforeach
                </ul>
          </div>
        </div>

        <div class="col-md-10 col-sm-9">
          <ol class="breadcrumb nav_list" id="about_nav_list">
            <li><a href="/"><span class="glyphicon glyphicon-home"></span> 首頁</a></li>
            @if ($title != NULL)
              <li><a href="/about">關於我們</a></li>
              <li class="active">{{ $title }}</li>
            @else
              <li class="active">關於我們</li>
            @endif
          </ol>
        </div>

        <div id="about_content_wrap" class="col-md-10 col-sm-9">
            <div id="about_content">
                @isset($content)
                <h1>{{ $content->title }}</h1><br>
                <p>{{ $content->content }}</p>
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection