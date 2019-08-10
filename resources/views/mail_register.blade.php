<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Email</title>
    </head>
    <body>
        <h2>Chào {{ $full_name }},</h2>
        <br/>
        Tài khoản đăng ký của bạn là {{ $name }}
        <br/>
        Mật khẩu: {{ $password }}
        <br/>
        Click vào link dưới đây để kích hoạt tài khoản của bạn
        <br/>
        <a href="{{url('registry', $token)}}">Kích hoạt tài khoản</a>
    </body>
</html>