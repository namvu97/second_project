@extends("home_layout")
@section("content")
<div class="col-md-8 col-xs-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Thêm Sửa ví</div>
        <div class="panel-body">
            <form method="post" action="" enctype="multipart/form-data" id="formAddEditWallet">
                @if(Request::get("err") == "wallet_name-exists")
                <div >
                    <strong><div class = "alert alert-danger" role="alert"> Tên ví đã tồn tại</div></strong>
                </div>
                @endif
                @if(Request::get("err") == "account_number-exists")
                <div>
                    <strong><div class = "alert alert-danger" role="alert"> Số tài khoản đã tồn tại</div></strong>
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
                    <div class="col-md-2">Tên ví</div>
                    <div class="col-md-10">
                        <input type="text" value="{{ isset($record->wallet_name)?$record->wallet_name:'' }}" name="wallet_name" class="form-control">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Số tài khoản</div>
                    <div class="col-md-10">
                        <input type="text" value="{{ isset($record->account_number)?$record->account_number:'' }}" name="account_number" class="form-control">
                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Số dư hiện tại</div>
                    <div class="col-md-10">
                        <input type="text" name="current_balance" id="current_balance" value="<?php echo isset($record->current_balance) ? $record->current_balance : ''; ?>" placeholder="1,000,000 ₫" class="money-text form-control">
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
        $('#formAddEditWallet').validate({
            rules: {
                account_number: {
                    required: true,
                    minlength: 6,
                    maxlength: 9,
                },
                current_balance: {
                    required: true,
                },
                wallet_name: {
                    maxlength: 16,
                    required: true,
                }
            },
            messages: {
                account_number: {
                    required: "Số tài khoản không được để trống",
                    minlength: "Số tài khoản phải có ít nhất 6 ký tự",
                    maxlength: "Số tài khoản phải dưới 15 ký tự",
                },
                current_balance: {
                    required: "Số dư hiện tại không được để trống",
                },
                wallet_name: {
                    required: "Tên ví không được để trống",
                    maxlength: "Tên ví phải dưới 16 ký tự",
                }
            }
        });
    });

</script>
@endsection