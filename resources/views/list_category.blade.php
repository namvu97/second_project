@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
    @if(session('change_password_at') == null)
    <div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
    @endif
    @if(Request::get("mess") == "add_category-success")
    <div style="margin-top: 10px;" class="alert alert-success">Thêm danh mục thành công</div>
    @endif
    @if(Request::get("mess") == "edit_category-success")
    <div style="margin-top: 10px;" class="alert alert-success">Sửa danh mục thành công</div>
    @endif
    <div style="margin-bottom:5px;">
        <a href="{{ url('admin/category/add') }}" class="btn btn-primary">Thêm danh mục</a>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Danh sách danh mục</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <th class="text-md-center">STT</th>
                    <th class="text-md-center">Tên danh mục</th>
                    <th class="text-md-center">Loại danh mục</th>
                    <th class="text-md-center" style="width:300px;">Hành động</th>
                </tr>
                @foreach($arr as $key=>$rows)
                <tr>
                    <td class="text-md-center">{{ ++$key }}</td>
                    <td class="text-md-center">{{$rows->category_name}}</td>
                    @if ($rows->category_type == "0")
                    <td class="text-md-center">Thu</td>
                    @else
                    <td class="text-md-center">Chi</td>
                    @endif
                    <td style="text-align:center;">
                        <a class="btn btn-info" href="{{ url('admin/category/edit/'.$rows->id) }}">Sửa</a>&nbsp;
                        <a class="btn btn-danger" href="{{ url('admin/category/delete/'.$rows->id) }}" onclick="return window.confirm('Bạn có chắc không?');">Xóa</a>
                    </td>
                </tr>
                @endforeach
            </table>
            <style type="text/css">
                .pagination{padding:0px; margin:0px;}
            </style>
            {{ $arr->render() }}
        </div>
    </div>
</div>
@endsection