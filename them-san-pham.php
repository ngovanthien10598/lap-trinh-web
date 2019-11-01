<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: /dang-nhap.php");
}

$message = "";

require('./database.php');
if (isset($_POST["tensp"], $_POST["chitietsp"], $_POST["giasp"], $_FILES["hinhanhsp"])) {
  $tensp = $_POST["tensp"];
  $chitietsp = $_POST["chitietsp"];
  $giasp = $_POST["giasp"];
  $hinhanhsp = $_FILES["hinhanhsp"];
  $userid = $_SESSION["user"]["userid"];

  $imageLink = '/sanpham/' . $hinhanhsp["name"];
  $uploadPath = '.' . $imageLink;

  if (move_uploaded_file($hinhanhsp["tmp_name"], $uploadPath)) {
    $sql = "INSERT INTO sanpham(tensp, chitietsp, giasp, hinhanhsp, idtv) VALUES ('$tensp', '$chitietsp', $giasp, '$imageLink', $userid)";
    if ($con->query($sql)) {
      $message = "Thêm sản phẩm thành công";
    } else {
      $message = "Có lỗi xảy ra";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <link rel="stylesheet" href="/css/themsanpham.css">
  <title>Thêm sản phẩm</title>
</head>

<body>
  <main class="container themsanpham">
    <?php include('./partials/nav.php'); ?>
    <form action="/them-san-pham.php" method="post" enctype="multipart/form-data" class="form">
      <?php if (strlen($message) > 0) {
        echo '<p class="message success">' . $message . '</p>';
      } ?>
      <table>
        <!-- Tên sản phẩm -->
        <tr>
          <td>Tên sản phẩm</td>
          <td>
            <input class="form-control" type="text" name="tensp" required>
          </td>
        </tr>

        <!-- Chi tiết sản phẩm -->
        <tr>
          <td>Chi tiết</td>
          <td>
            <textarea class="form-control" name="chitietsp" rows="3" required></textarea>
          </td>
        </tr>

        <!-- Giá -->
        <tr>
          <td>Giá sản phẩm</td>
          <td>
            <input class="form-control" type="number" name="giasp" required>
          </td>
        </tr>

        <!-- Hình ảnh -->
        <tr>
          <td>Hình ảnh</td>
          <td>
            <input class="form-control" type="file" name="hinhanhsp" required>
          </td>
        </tr>

        <tr>
          <td></td>
          <td>
            <button class="button" type="submit">Thêm</button>
            <button class="button" type="reset">Làm lại</button>
          </td>
        </tr>
      </table>
    </form>
  </main>
</body>

</html>