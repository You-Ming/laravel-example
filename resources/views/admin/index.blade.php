@extends('admin.layouts.app')

@section('title', 'Admin')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_welcome'>
  <h2>歡迎使用後台管理系統!</h2>
</div>
@endsection