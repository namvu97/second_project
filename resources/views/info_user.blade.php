@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
    <div class="panel panel-primary">
        <div class="panel-heading">Thông tin tài khoản</div>
        <div class="panel-body">
            @if($arr->photo != '')
            <img src="upload/photo/{{$arr->photo}}" style="width: 100px;">
            @endif
            <table class="table table-striped">
                <tr>
                    <th>Họ tên</th>
                    <td>{{$arr->full_name}}</td>
                </tr>
                <tr>
                    <th>Tài khoản</th>
                    <td>{{$arr->username}}</td>
                </tr>   
                <tr>
                    <th>Địa chỉ Email</th>
                    <td>{{$arr->email}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection