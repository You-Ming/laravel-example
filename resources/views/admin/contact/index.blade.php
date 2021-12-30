@extends('admin.layouts.app')

@section('title', 'Admin - Contact')

@section('breadcrumb')
    @include('admin.layouts.breadcrumb')
@endsection

@section('main')
<script>
    $(function(){
      $("#txt_search_contact").keypress(function(){
        var key = event.keyCode;
        if(key == 13){
          $("#btn_search_contact").click();
        }
      })
    });
    
</script>
<div id='admin_contact'>
    <h3>聯絡我們管理</h3>
    <div class="form-group">
        <div class="input-group search-group">
            <input type="text" class="form-control input-search" id="txt_search_contact" placeholder="請輸入關鍵字">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default image-preview-input" id="btn_search_contact">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
    </div><br>
    <table id='tb_admin_contact' class="table table-bordered">
        <tr>
            <th class="tb_contact_title">留言主旨</th>
            <th class="tb_contact_name">留言者</th>
            <th class="tb_contact_time">留言時間</th>
            <th class="tb_contact_btn">查看/刪除</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td class="tb_contact_title">
                {{ $contact->title }}
            </td>
            <td class="tb_contact_name">
                {{ $contact->name }}
            </td>
            <td class="tb_contact_time">
                {{ $contact->created_at }}
            </td>
            <td class="tb_contact_btn">
                <button type="button" class="btn btn-info btn-sm" onclick="window.location.href='{{ route('admin.contact.show', ['contact' => $contact->id]) }}'">
                    <span class="glyphicon glyphicon-eye-open"></span> <span class="btn_admin">查看</span>
                </button>
                <button class="btn btn-danger btn-sm" data-toggle="confirmation_contact" data-title="確定要刪除嗎?" data-id="{{ $contact->id }}" data-singleton="true">
                    <span class="glyphicon glyphicon-remove"></span> <span class="btn_admin">刪除</span>
                </button>
            </td>
        </tr>
        @endforeach
    </table>

    <div class="admin_page_link" align="center">
        <ul class="pagination">
            {{ $contacts->links() }}
        </ul>
    </div>
</div>

@endsection