@extends('admin.layouts.app')

@section('title', 'Admin - Contact Show')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<div id='admin_contact'>
    <h3>留言內容</h3>
    <table id="tb_admin_contact_content" class="table table-bordered">
        <tr>
            <th>訪客姓名</th>
            <td>
                {{ $contact->name }}
            </td>
        </tr>
        <tr>
            <th>訪客信箱</th>
            <td>
                {{ $contact->email }}
            </td>
        </tr>
        <tr>
            <th>留言主旨</th>
            <td>
                {{ $contact->title }}
            </td>
        </tr>
        <tr>
            <th>留言內容</th>
            <td>
                {{ $contact->content }}
            </td>
        </tr>
        <tr>
            <th>留言時間</th>
            <td>
                {{ $contact->created_at }}
            </td>
        </tr>
    </table>

    <button type="button" class="btn btn-primary btn-sm" onclick="window.location.href='{{ route('admin.contact.index') }}'">返回</button>
    <button class="btn btn-danger btn-sm" data-toggle="confirmation_contact" data-title="確定要刪除嗎?" data-id="{{ $contact->id }}" data-singleton="true">刪除</button>
</div>
@endsection