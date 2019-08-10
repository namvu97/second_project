@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
    <div class="panel panel-primary">
        @if ($type == "type=category_revenue")
        <div class="panel-heading">Thêm Sửa giao dịch theo danh mục thu</div>
        @elseif ($type == "type=category_expense")
        <div class="panel-heading">Thêm Sửa giao dịch theo danh mục chi</div>
        @elseif ($type == "type=tranfer")
        <div class="panel-heading">Thêm Sửa giao dịch chuyển khoản</div>
        @endif
        <div class="panel-body">
            <form method="post" action="" id="formAddEditCategory">
                @if (Request::get("err") == "category_name-exists")
                <div style="margin-bottom: 5px;">
                    <strong><div class = "alert alert-danger">Giao dịch đã tồn tại</div></strong>
                </div>
                @endif
                @if (Request::get("err") == "money")
                <div style="margin-bottom: 5px;">
                    <strong><div class = "alert alert-danger">Số tiền không hợp lệ</div></strong>
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
                    <div class="col-md-2">Từ ví</div>
                    <div class="col-md-6">
                        @if ($type == "type=category_expense" || $type == "type=tranfer")
                        <select class="form-control" name="from_wallet" style="height: 30px; width:325px; text-align-last: center;">
                            @foreach($wallet as $rows)
                            <option @if(isset($record->from_wallet) && $record->from_wallet == $rows->wallet_name) selected @endif value="{{ $rows->wallet_name }}">{{ $rows->wallet_name }} ({{ number_format($rows->current_balance) }} VNĐ)</option>
                            @endforeach
                        </select>
                        @elseif ($type == "type=category_revenue")
                        <input value="{{ isset($record->from_wallet)?$record->from_wallet:'' }}" type="text" id="from_wallet" name="from_wallet" class="form-control">
                        @endif
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Đến ví</div>
                    <div class="col-md-6">
                        @if ($type == "type=category_revenue" || $type == "type=tranfer")
                        <select class="form-control" name="to_wallet" style="height: 30px; width:325px; text-align-last: center;">
                            @foreach($wallet as $rows)
                            <option @if(isset($record->to_wallet) && $record->to_wallet == $rows->wallet_name) selected @endif value="{{ $rows->wallet_name }}">{{ $rows->wallet_name }} ({{ number_format($rows->current_balance) }} VNĐ)</option>
                            @endforeach
                        </select>
                        @elseif ($type == "type=category_expense")
                        <input value="{{ isset($record->to_wallet)?$record->to_wallet:'' }}" type="text" id="to_wallet" name="to_wallet" class="form-control">
                        @endif
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Số tiền</div>
                    <div class="col-md-6">
                        <input type="text" value="{{ isset($record->amount)?$record->amount:'' }}" id="amount" name="amount" class="money-text form-control">
                    </div>
                </div>
                <!-- end rows -->
                @if ($type == "type=category_revenue")
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Danh mục</div>
                    <div class="col-md-6">
                        <select class="form-control" name="category_id" style="height: 30px; width:325px; text-align-last: center; margin-bottom: 10px;">
                            @foreach($revenue as $rows)
                            <option @if(isset($record->category_id) && $record->category_id == $rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end rows -->
                @elseif ($type == "type=category_expense")
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Danh mục</div>
                    <div class="col-md-6">
                        <select class="form-control" name="category_id" style="height: 30px; width:325px; text-align-last: center; margin-bottom: 10px;">
                            @foreach($expense as $rows)
                            <option @if(isset($record->category_id) && $record->category_id == $rows->id) selected @endif value="{{ $rows->id }}">{{ $rows->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end rows -->
                @endif
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2" >Thời gian</div>
                    <div class="col-md-6">
                        <input value="{{ isset($record->time)?$record->time:'' }}" type="date" id="time" name="time" class="form-control">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div style="margin-left: 45px;" class="col-md-3"></div>
                    <div class="col-md-6">
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
                from_wallet: {
                    maxlength: 16,
                    required: true,
                },
                to_wallet: {
                    maxlength: 16,
                    required: true,
                },
                amount: {
                    required: true,
                },
                time: {
                    required: true,
                }
            },
            messages: {
                from_wallet: {
                    maxlength: "Tên ví phải dưới 16 ký tự",
                    required: "Ví gửi tiền không được để trống",
                },
                to_wallet: {
                    maxlength: "Tên ví phải dưới 16 ký tự",
                    required: "Ví nhận tiền không được để trống",
                },
                amount: {
                    required: "Số lượng không được để trống",
                },
                time: {
                    required: "Thời gian không được để trống",
                }
            }
        });
    });
</script>
@endsection