@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Thêm Sửa danh mục</div>
        <div class="panel-body">
            <form method="post" action="" id="formAddEditCategory">
                @if (Request::get("err") == "category_name-exists")
                <div style="margin-bottom: 5px;">
                    <strong><div class = "alert alert-danger">Danh mục đã tồn tại</div></strong>
                </div>
                @endif
                @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong>
                </div>					
                @endforeach
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3">Tên danh mục</div>
                    <div class="col-md-6">
                        <input type="text" value="{{ isset($record->category_name)?$record->category_name:'' }}" name="category_name" class="form-control" >
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3">Loại danh mục</div>
                    <div class="col-md-5">
                        <select name="category_type" style="width:145px; text-align-last: center;">
                            <option @if(isset($record->category_type) && $record->category_type == 0) selected @endif value="0" >Thu</option>
                            <option @if(isset($record->category_type) && $record->category_type == 1) selected @endif value="1" >Chi</option>
                        </select>
                    </div>
                </div>
                <!-- end form group -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <input type="submit" value="Lưu thông tin" class="btn btn-primary">
                    </div>
                </div>
                <!-- end rows -->
            </form>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#formAddEditCategory').validate({
            rules: {
                category_name: {
                    required: true,
                    maxlength: 20,
                }
            },
            messages: {
                category_name: {
                    required: "Tên danh mục không được để trống",
                    maxlength: "Tên ví phải dưới 20 ký tự",
                }
            }
        });
    });
</script>
@endsection