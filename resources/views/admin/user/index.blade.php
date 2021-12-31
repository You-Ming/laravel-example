@extends('admin.layouts.app')

@section('title', 'Admin - User')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')

<!-- admin user -->
<div id='admin_user'>
    <h3>帳號管理</h3>
    <table id='tb_admin_user' class="table table-bordered">
        <tr>
            <th width="30%">管理者名稱</th>
            <th width="40%">管理者E-mail</th>
            <th width="15%">修改</th>
            <th width="15%">刪除</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ route('admin.user.edit', ['user' => $user->id]) }}'">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <span class="btn_admin">修改</span>
                </button>
            </td>
            <td>
                <button class="btn btn-danger btn-sm" data-toggle="confirmation_user" data-title="確定要刪除嗎?" data-id="{{ $user->id }}" data-email="{{ $user->email }}" data-singleton="true">
                    <span class="glyphicon glyphicon-remove"></span>
                    <span class="btn_admin">刪除</span>
                </button>
            </td>
        </tr>
        @endforeach
    </table>
    <button type="button" class="btn btn-primary" id="btn_creat_user" onclick="window.location.href='{{ route('admin.user.create') }}'">新增</button>
</div>
<!-- end admin user -->

<!--modal 刪除帳號-->
<div class="modal fade" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="modal_user_label" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modl_user_label">刪除帳號</h4>
            </div>
            <div class="modal-body">
                <p>刪除帳號: <span id="text_del_user"></span></p>
                <p>請輸入此帳號密碼</p>
                <input type="password" id="del_password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="btn_delete_user" data-id="{{ $user->id }}">確定刪除</button>
            </div>
        </div>
    </div>
</div>
<!--end modal-->
@endsection