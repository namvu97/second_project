@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
    @if ($type!= "type=time")
    <div style="margin-bottom:5px;">
        <a href="{{ url('admin/transaction/'.$type.'/add') }}" class="btn btn-primary">Thêm giao dịch</a>
    </div>
    @endif
    @if(Request::get("mess") == "add_transaction-success")
    <div style="margin-top: 10px;" class="alert alert-success">Thêm giao dịch thành công</div>
    @endif
    @if(Request::get("mess") == "edit_transaction-success")
    <div style="margin-top: 10px;" class="alert alert-success">Sửa giao dịch thành công</div>
    @endif
    <div style="margin-top:10px;" class="panel panel-primary">
        @if ($type== "type=time")
        <div class="panel-heading">Lịch sử giao dịch</div>
        @else
        <div class="panel-heading">Quản lý giao dịch</div>
        @endif
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr >
                    <th class="text-md-center">STT</th>
                    <th class="text-md-center">Từ tài khoản</th>
                    <th class="text-md-center">Đến tài khoản</th>
                    <th class="text-md-center">Số tiền</th>
                    @if ($type == "type=time")
                    <th class="text-md-center">Thời gian</th>
                    @elseif ($type == "type=tranfer")
                    <th class="text-md-center">Thời gian</th>
                    <th class="text-md-center">Thuộc loại</th>
                    @else
                    <th class="text-md-center">Thuộc loại</th>
                    <th class="text-md-center">Danh mục</th>
                    @endif
                    @if ($type != "type=time")
                    <th class="text-md-center" style="width:200px;">Hành động</th>
                    @endif
                </tr>
                @foreach($arr as $key => $rows)
                <tr>
                    <td class="text-md-center">{{ ++$key }}</td>
                    <td class="text-md-center">{{ $rows->from_wallet }}</td>
                    <td class="text-md-center">{{ $rows->to_wallet }}</td>
                    <td class="text-md-center">{{ number_format($rows->amount) }} VNĐ</td>
                    @if ($type== "type=time")
                    <td class="text-md-center">{{ $rows->time }}</td>
                    @elseif ($type== "type=tranfer")
                    <td class="text-md-center">{{ $rows->time }}</td>
                    <td class="text-md-center">Chuyển khoản</td>
                    @elseif ($type== "type=category_revenue")
                    <td class="text-md-center">Thu</td>
                    <td class="text-md-center">{{ $rows->category_name }}</td>
                    @elseif ($type== "type=category_expense")
                    <td class="text-md-center">Chi</td>
                    <td class="text-md-center">{{ $rows->category_name }}</td>
                    @endif
                    
                    @if($type != "type=time")
                    <td style="text-align:center;">
                        <a class="btn btn-info" href="{{ url('admin/transaction/'.$type.'/edit/'.$rows->id) }}">Sửa</a>&nbsp;
                        <a class="btn btn-danger" href="{{ url('admin/transaction/'.$type.'/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
                    </td>
                    @endif
                </tr>
                @endforeach
                {{ $arr->render() }}
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
        </div>
    </div>
</div>
@endsection