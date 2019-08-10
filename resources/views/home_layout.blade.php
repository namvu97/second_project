<!DOCTYPE html>
<html>
    <head>
        <title>Admin page</title>
        <base href="{{asset('')}}">
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="source/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="text/javascript" type="text/css" href="source/js/jquery/jquery-3.4.1.min.js">
        <script src="source/js/jquery/jquery.min.js"></script>
        <script src="source/js/bootstrap.min.js"></script>
        <script src="source/js/jquery.validate.min.js"></script>
        <script src="source/js/autoNumeric/autoNumeric.js" type="text/javascript"> </script>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
    <body style="background-image:url({{url('source/bg/bg.jpg')}})">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="brand nav-item font-weight-bold"><a class="nav-link" href="{{ url('home') }}">Hệ thống quản lý tài chính<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item font-weight-bold active"><a class="nav-link" href="{{ url('admin/wallet') }}">Quản lý ví</a></li>
                    <li class="nav-item font-weight-bold active" ><a class="nav-link" href="{{ url('admin/category') }}">Quản lý danh mục</a></li>
                    <li class="nav-item dropdown active font-weight-bold">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Quản lý giao dịch</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('admin/transaction/type=category_revenue') }}">Theo danh mục thu</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('admin/transaction/type=category_expense') }}">Theo danh mục chi</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('admin/transaction/type=tranfer') }}">Chuyển khoản</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown active font-weight-bold">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Báo cáo</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('admin/transaction/type=time') }}">Lịch sử giao dịch</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('admin/transaction/report') }}">Báo cáo thu chi</a>
                        </div>
                    </li>
                    <span style="width: 490px;"></span>
                    <li class="nav-item ">
                        <div class="nav-link dropdown">
                            <button class=" btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Tài khoản {{ session('username') }}
                            </button>
                            <ul style="margin-left: 5px;" class="dropdown-menu">
                                <li><a href="{{ url('info') }}">Hồ sơ</a></li>
                                <li><a href="{{ url('password/change') }}">Đổi mật khẩu</a></li>
                                <li><a href="{{ url('logout') }}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>        
            </div>
        </nav>
        <div class="container" style="margin-top:10px;">
            @yield('content')
        </div>
    </body>
</html>
