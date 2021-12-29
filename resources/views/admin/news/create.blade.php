@extends('admin.layouts.app')

@section('title', 'Admin - News Create')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_news_create'>
    <h3>新增新聞</h3>
    <form id="formSetNews" class="form-inline" role="form">
        @csrf
        <div class="form-group">
            <label for="txt_news_title" class="control-label">標題:</label>
            <input type="text" name="txt_news_title" class="form-control" id="txt_news_title" placeholder="請輸入標題"><br><br>
        </div>

        <div class="foum-group">
            <label for="time_news" class="control-label">時間:</label>
            <div class='input-group' id='datetimepicker_set_news'>
                <input type="text" name="time_news" class="form-control" id="time_news">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
        </div>

        <br>

        <script type="text/javascript">
            $(function () {
                $('#datetimepicker_set_news').datetimepicker({
                    locale: 'zh-tw',
                    format: 'YYYY-MM-DD HH:mm:ss'
                });
            });
        </script>
        <script src="/asset/ckeditor/ckeditor.js"></script>
        <script src="/asset/ckfinder/ckfinder.js"></script>


        <textarea id="textarea_set_news" name="textarea_set_news"></textarea><br>
        <script>
            CKFinder.setupCKEditor();
            CKEDITOR.replace( 'textarea_set_news', {width:1000,});
        </script>

        <input type="button" class="btn btn-primary btn-sm" id="btn_create_news" value="送出">
        <input type="button" class="btn btn-primary btn-sm" value="返回" onclick="window.location.href='{{ route('admin.news.index') }}'">
    </form>
</div>

@endsection