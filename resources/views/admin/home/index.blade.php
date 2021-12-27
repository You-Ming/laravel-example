@extends('admin.layouts.app')

@section('title', 'Admin - Banner')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_banner'>
    <h3>橫幅管理</h3>
    <table id='tb_admin_banner' class="table table-bordered">
      <tr>
        <th width="39%">橫幅名稱</th>
        <th width="39%">橫幅圖片</th>
        <th width="22%">修改/刪除</th>
      </tr>

      @foreach ($banners as $banner)
      <tr>
        <td>{{ $banner->name }}</td>
        <td><img src="/storage/uploads/images/banner/{{ $banner->image_name }}" class="img_admin_banner"></td>
        <td>
          <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ route('admin.home.edit', ['home' => $banner->id]) }}'"><span class="glyphicon glyphicon-pencil"></span> <span class="btn_admin">修改</span></button>
          <button class="btn btn-danger btn-sm" data-toggle="confirmation_banner" data-title="確定要刪除嗎?" data-id="{{ $banner->id }}" data-name="{{ $banner->image_name }}" data-singleton="true">
          <span class="glyphicon glyphicon-remove"></span> <span class="btn_admin">刪除</span>
          </button>
        </td>
      </tr>
      @endforeach

    </table>
    <button type="button" class="btn btn-primary" id="btn_creat_banner" onclick="window.location.href='{{ route('admin.home.create') }}'">新增</button>
</div>
@endsection