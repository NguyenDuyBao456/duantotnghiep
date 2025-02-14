
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Q7X2CdxnL8iVZtY9yqkdj6UyPvn9jER22tKQ/NOkUGT60M6VfklCj0V9kx4cfTeQ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0HfDmjUuZq7gbY6M5kfjVfW5lLeIpD+zqAkqkfrt5Z7vw6Dl" crossorigin="anonymous"></script>

</head>
<body>
<div class="d-flex" style="width: 100%; height: 100vh">
    <!-- Sidebar -->
    <div class="sidebar">

      <h2>Admin Dashboard</h2>
      <a href="/admin/sanpham">Quản lý sản phẩm</a>
      <a href="/admin/danhmuc">Quản lý danh mục</a>
      <a href="user?ctrl=admin&views=user">Quản lý người dùng</a>
      <a href="?ctrl=admin&views=order">Quản lý đơn hàng</a>
      <a href="?ctrl=admin&views=bieudo">Số liệu thống kê</a>
      <a href="welcome?ctrl=admin&views=welcome">Back To Website</a>
    </div>

