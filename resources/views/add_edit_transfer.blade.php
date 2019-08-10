@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Chuyển khoản</div>
        <div class="panel-body">
            <form method="post" action="" enctype="multipart/form-data" id="formAddEditTransfer">
                @if(Request::get("err") == "wallet")
                <div >
                    <strong><div class = "alert alert-danger" role="alert">Chuyển khoản không hợp lệ</div></strong>
                </div>
                @endif
                @if(Request::get("err") == "money")
                <div >
                    <strong><div class = "alert alert-danger" role="alert">Số tiền chuyển không hợp lệ</div></strong>
                </div>
                @endif
                @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong>
                </div>					
                @endforeach
                @endif
                @csrf

                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Từ ví</div>
                    <div class="col-md-10">
                        <select class="form-control" name="from_wallet" style="height: 30px; width:265px; text-align-last: center;">
                            @foreach($record as $key=>$rows)
                            <option value="{{ $rows->wallet_name }}">{{ $rows->wallet_name }} ({{ number_format($rows->current_balance) }} VNĐ)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Đến ví</div>
                    <div class="col-md-10">
                        <select class="form-control" name="to_wallet" style="height: 30px; width:265px; text-align-last: center;">
                            @foreach($record as $key=>$rows)
                            <option value="{{ $rows->wallet_name }}">{{ $rows->wallet_name }} ({{ number_format($rows->current_balance) }} VNĐ)</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Số tiền</div>
                    <div class="col-md-5">
                        <input type="text" value="{{ isset($record->amount)?$record->amount:'' }}" id="amount" name="amount" class="money-text form-control">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Thời gian</div>
                    <div class="col-md-5">
                        <input type="date" id="time" name="time" class="form-control">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
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
        $('#formAddEditTransfer').validate({
            rules: {
                amount: {
                    required: true,
                },
                time: {
                    required: true,
                }
            },
            messages: {
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