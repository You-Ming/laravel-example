@extends('admin.layouts.app')

@section('title', 'Admin - Product Type')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_productType'>
    <h3>產品分類管理</h3>
    <table id='tb_admin_productType' class="table table-bordered">
        <tr>
            <th width="60%">產品分類名稱</th>
            <th width="20%">修改</th>
            <th width="20%">刪除</th>
        </tr>
        @foreach ($product_types as $product_type)
        <tr>
            <td>{{ $product_type->name }}</td>
            <td><button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ route('admin.product_type.edit', ['product_type' => $product_type->id]) }}'">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <span class="btn_admin">修改</span>
                </button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm" data-toggle="confirmation_type" data-title="確定要刪除嗎?" data-id="{{ $product_type->id }}" data-singleton="true">
                    <span class="glyphicon glyphicon-remove"></span>
                    <span class="btn_admin">刪除</span>
                </button>
            </td>
        </tr>
        @endforeach
    </table>
    <button type="button" class="btn btn-primary" id="btn_creat_productType" onclick="window.location.href='{{ route('admin.product_type.create') }}'">新增</button>
</div>
@endsection