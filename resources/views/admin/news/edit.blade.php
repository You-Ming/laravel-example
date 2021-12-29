@extends('admin.layouts.app')

@section('title', 'Admin - News Edit')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_news_update'>
    <h3>修改新聞</h3>
    <form id="formUpdateNews" class="form-inline" role="form">
        @csrf

        <div class="form-group">
            <label for="txt_update_news" class="control-label">標題:</label>
            <input type="text" name="txt_update_news" class="form-control" id="txt_update_news" value="{{ $news_item->title }}"><br><br>
        </div>

        <div class="foum-group">
            <label for="time_news_update" class="control-label">時間:</label>
            <div class='input-group' id='datetimepicker_update_news'>
                <input type="text" name="time_news_update" class="form-control" id="time_mews_update" value="{{ $news_item->created_at }}">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <br>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker_update_news').datetimepicker({
                    locale: 'zh-tw',
                    format: 'YYYY-MM-DD HH:mm:ss'
                });
            });
        </script>
        <script src="/asset/ckeditor/ckeditor.js"></script>
        <script src="/asset/ckfinder/ckfinder.js"></script>

        <textarea id="textarea_update_news" name="textarea_update_news">{{ $news_item->content }}</textarea><br>
        <script>
            CKFinder.setupCKEditor();
            CKEDITOR.replace( 'textarea_update_news', {width:1000});
        </script>

        <input type="button" class="btn btn-primary btn-sm" id="btn_update_news" data-id="{{ $news_item->id }}" value="送出">
        <input type="button" class="btn btn-primary btn-sm" id="btn_back_admin_news" value="返回" onclick="window.location.href='{{ route('admin.news.index') }}'">

    </form>
</div>

@endsection