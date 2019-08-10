@extends("home_layout")
@section("content")
<div class="col-md-10 col-xs-offset-1">
    @if(session('change_password_at') == null)
    <div class="alert alert-danger">Bạn chưa thay đổi mật khẩu mặc định</div>
    @endif
    <form style="margin-bottom:20px;" action="{{ url('admin/transaction/create/report') }}" class="row" id="indexForm" method="get" accept-charset="utf-8">
        <div class="col-xs-2 col-md-2 form-group">
            <label for="year" class="control-label"></label>
            <select class="form-control" name="year">
                @for ($year=2019; $year >= 2010; $year--)
                <option value="{{ $year }}">Năm {{ $year }}</option>
                @endfor
            </select>
        </div>
        <div class="col-xs-2 col-md-2 form-group">
            <label for="month" class="control-label"></label>
            <select class="form-control" name="month">
                @for ($month = 1; $month <= 12; $month++)
                <option value="{{ $month }}">Tháng {{ $month }}</option>
                @endfor
            </select>
        </div>
        <div class="col-xs-2">
            <label class="control-label"></label><br>
            <input class="btn btn-primary" type="submit" value="Lựa chọn tháng">
        </div>
    </form>
    <div style="margin-top:10px;" class="panel panel-primary">
        <div class="panel-heading">Báo cáo thu chi theo tháng</div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <table class="table table-bordered table-striped">
                            <tbody><tr>
                                    <th>Thu</th>
                                    <td>@if(isset($total_revenue)) 
                                        {{ number_format($total_revenue) }} VNĐ
                                        @endif
                                    </td>

                                </tr>
                                <tr>
                                    <th>Chi</th>
                                    <td>@if(isset($total_expense)) 
                                        {{ number_format($total_expense) }} VNĐ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Lãi xuất</th>
                                    <td>@if(isset($profit)) 
                                        {{ number_format($profit) }} VNĐ
                                        @endif
                                    </td>
                                </tr>
                            </tbody></table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Thu theo danh mục</th>
                                    <th>@if(isset($total_revenue)) 
                                        {{ number_format($total_revenue) }} VNĐ
                                        @endif
                                    </th>
                                </tr>
                                @if(isset($revenue)) 
                                @foreach ($revenue as $key => $rows)
                                <tr>
                                    <th>{{ $rows->category_name }}</th>
                                    <td>{{ number_format($rows->total) }} VNĐ</td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Chi theo danh mục</th>
                                    <th>@if(isset($total_expense)) 
                                        {{ number_format($total_expense) }} VNĐ
                                        @endif
                                    </th>
                                </tr>
                                @if(isset($expense)) 
                                @foreach ($expense as $key => $rows)
                                <tr>
                                    <th>{{ $rows->category_name }}</th>
                                    <td>{{ number_format($rows->total) }} VNĐ</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection