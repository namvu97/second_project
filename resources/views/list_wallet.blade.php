@extends("home_layout")
@section("content")

<div class="col-md-11 col-xs-offset-1" >
    @if(session('change_password_at') == null)
    <div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
    @endif
    <span style="margin-bottom:50px; margin-right:10px;">
        <a href="{{ url('admin/wallet/add') }}" class="btn btn-primary">Thêm ví mới</a>
    </span>
    <span style="margin-bottom:50px; margin-right:10px;">
        <a href="{{ url('admin/wallet/transfer') }}" class="btn btn-primary">Chuyển tiền</a>
    </span>
    @if(Request::get("mess") == "add_wallet-success")
    <div style="margin-top: 10px;" class="alert alert-success">Thêm ví thành công</div>
    @endif
    @if(Request::get("mess") == "edit_wallet-success")
    <div style="margin-top: 10px;" class="alert alert-success">Sửa ví thành công</div>
    @endif
    <div style="margin-top:10px;" class="panel panel-primary">
        <div class="panel-heading">Danh sách ví</div>
        <div class="panel-body" >
            <form action="{{ url('password/reset') }}" method="post" >
                {{csrf_field() }}
                <table class="table table-bordered table-hover table-striped" >
                    <tr >
                        <th class="text-md-center">STT</th>
                        <th class="text-md-center">Tên ví</th>
                        <th class="text-md-center">Số tài khoản</th>
                        <th class="text-md-center">Số dư tài khoản</th>
                        <th class="text-md-center" style="width:300px;">Hành động</th>
                    </tr>
                    @foreach($arr as $key => $rows)
                    <tr>
                        <td class="text-md-center">{{ ++$key }}</td>
                        <td class="text-md-center">{{ $rows->wallet_name }}</td>
                        <td class="text-md-center">{{ $rows->account_number }}</td>
                        <td class="text-md-center">{{ number_format($rows->current_balance) }} VNĐ</td>
                        <td style="text-align:center;">
                            <a class="btn btn-info" href="{{ url('admin/wallet/edit/'.$rows->id) }}">Sửa</a>&nbsp;
                            <a class="btn btn-danger" href="{{ url('admin/wallet/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <style type="text/css">
                    .pagination{padding:0px; margin:0px;}
                </style>
                {{ $arr->render() }}
            </form>
        </div>
    </div>
</div>
@endsection