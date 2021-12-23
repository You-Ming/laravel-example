<!-- 導覽列 -->
<div class="col-md-10 col-sm-9">
    <ol class="breadcrumb nav_list" id="admin_nav_bar">
        <li><a href="/admin">首頁</a></li>
        @isset($breadcrumbs)
            @foreach ($breadcrumbs as $name => $link)
                @if (!$loop->last)
                    <li><a href="{{ $link }}">{{ $name }}</a></li>
                @else
                    <li class="active">{{ $name }}</li>
                @endif
            @endforeach
        @endisset
    </ol>
</div>
<!-- 導覽列 End -->