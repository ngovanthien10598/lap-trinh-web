<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: /dang-nhap.php");
}

$message = "";
$oldProduct;

require('./database.php');
if (isset($_GET["idsp"])) {
  $idsp = $_GET["idsp"];
  $sql = "SELECT idsp, tensp, chitietsp, giasp FROM sanpham WHERE idsp=$idsp";
  $result = $con->query($sql);
  if ($result->num_rows == 1) {
    $oldProduct = $result->fetch_assoc();
  }
} else {
  if (isset($_POST["tensp"], $_POST["chitietsp"], $_POST["giasp"], $_FILES["hinhanhsp"])) {
    $tensp = $_POST["tensp"];
    $chitietsp = $_POST["chitietsp"];
    $giasp = $_POST["giasp"];
    $idsp = $_POST["idsp"];
    $hinhanhsp = $_FILES["hinhanhsp"];

    $imageLink = '/sanpham/' . $hinhanhsp["name"];
    $uploadPath = '.' . $imageLink;

    if (move_uploaded_file($hinhanhsp["tmp_name"], $uploadPath)) {
      $sql = "UPDATE sanpham SET tensp='$tensp', chitietsp='$chitietsp', giasp=$giasp, hinhanhsp='$imageLink' WHERE idsp=$idsp";
      if ($con->query($sql)) {
        $message = "Cập nhật sản phẩm thành công";
        header("Location: /danh-sach-san-pham.php");
      } else {
        $message = "Có lỗi xảy ra";
        die();
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <link rel="stylesheet" href="/css/themsanpham.css">
  <title>Sửa sản phẩm</title>
</head>

<body>
  <main class="container themsanpham">
    <?php include('./partials/nav.php'); ?>
    <form action="/sua-san-pham.php" method="post" enctype="multipart/form-data" class="form">
      <?php if (strlen($message) > 0) {
        echo '<p>' . $message . '</p>';
      } ?>
      <table>
        <!-- Tên sản phẩm -->
        <tr>
          <td>Tên sản phẩm</td>
          <td>
            <input class="form-control" type="text" name="tensp" value="<?php echo $oldProduct["tensp"] ?>" required>
          </td>
        </tr>

        <!-- Chi tiết sản phẩm -->
        <tr>
          <td>Chi tiết</td>
          <td>
            <textarea class="form-control" name="chitietsp" rows="3" required><?php echo $oldProduct["chitietsp"] ?></textarea>
          </td>
        </tr>

        <!-- Giá -->
        <tr>
          <td>Giá sản phẩm</td>
          <td>
            <input class="form-control" type="number" name="giasp" value="<?php echo $oldProduct["giasp"] ?>" required>
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
            <button class="button" type="submit">Cập nhật</button>
            <button class="button" type="reset">Làm lại</button>
          </td>
        </tr>
      </table>
      <input type="hidden" name="idsp" value="<?php echo $oldProduct["idsp"] ?>">
    </form>
  </main>
</body>

</html>