<?php
session_start();
require('./database.php');
if (isset($_SESSION["user"])) {
  $user;
  $username = $_SESSION["user"]["username"];
  $sql = "SELECT id, tendangnhap, hinhanh, gioitinh, nghenghiep, sothich FROM thanhvien WHERE tendangnhap='$username'";
  $result = $con->query($sql);
  if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $_SESSION["user"]["userid"] = $user["id"];
  }
} else {
  header("Location: /dang-nhap.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <link rel="stylesheet" href="/css/thongtincanhan.css">
  <title><?php echo $user["tendangnhap"] ?></title>
</head>

<body>
  <main class="container thongtincanhan">
    <?php include('./partials/nav.php'); ?>
    <table>
      <tr>
        <td colspan="2" class="text-center">
          <img class="avatar" src="<?php echo $user["hinhanh"] ?>">
        </td>
      </tr>

      <tr>
        <td>Tên đăng nhập</td>
        <td><?php echo $user["tendangnhap"] ?></td>
      </tr>

      <tr>
        <td>Giới tính</td>
        <td><?php echo $user["gioitinh"] ?></td>
      </tr>

      <tr>
        <td>Sở thích</td>
        <td><?php echo $user["sothich"] ?></td>
      </tr>
    </table>
  </main>
</body>

</html>