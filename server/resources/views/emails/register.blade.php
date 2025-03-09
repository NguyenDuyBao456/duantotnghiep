<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào Mừng !</title>
</head>
<body>
    <h1>Xin chào</h1>
    <p>Cảm ơn bạn đã đăng ký tài khoản với chúng tôi.</p>
    <p>Thông tin tài khoản của bạn:</p>
    <p><b>Họ tên:</b>  {{$user['name']}}</p>
    <p><b>Email:</b>  {{$user['email']}}</p>
    <p><b>Mật khẩu:</b>  {{$user['password']}}</p>
</body>
</html>
