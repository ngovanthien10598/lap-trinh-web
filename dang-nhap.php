<?php
session_start();
require("./database.php");
$errorMessage = "";
if (isset($_POST["username"], $_POST["password"])) {
  $tendangnhap = $_POST["username"];
  $matkhau = $_POST["password"];
  $sql = "SELECT tendangnhap, matkhau FROM thanhvien WHERE tendangnhap='$tendangnhap' AND matkhau='" . md5($matkhau) . "'";
  $result = $con->query($sql);
  if ($result->num_rows == 1) {
    $_SESSION["user"] = ["username" => $tendangnhap];
    header("Location: /thong-tin-ca-nhan.php");
  } else {
    $errorMessage = "Sai tên đăng nhập hoặc mật khẩu, vui lòng đăng nhập lại";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php"); ?>
  <title>Đăng nhập</title>
</head>

<body>
  <div class="wrapper">
    <main class="container">
      <form action="/dang-nhap.php" method="post" class="form">
        <h1 class="form-title">Đăng nhập</h1>
        <?php
        if (strlen($errorMessage) > 0) { ?>
          <p class="message error"><?php echo $errorMessage ?></p>
        <?php }
        ?>

        <table>
          <tr>
            <td>Tên đăng nhập</td>
            <td><input class="form-control" type="text" name="username" required></td>
          </tr>
          <tr>
            <td>Mật khẩu</td>
            <td><input class="form-control" type="password" name="password" required></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <button class="button" type="submit">Đăng nhập</button>
              <button class="button" type="reset">Làm lại</button>
            </td>
          </tr>
          <tr>
            <td></td>
            <td>Chưa có tài khoản? <a href="/dang-ky.php">Đăng ký</a></td>
          </tr>
        </table>
      </form>
    </main>
  </div>
</body>

</html>