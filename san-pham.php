<?php
require("./database.php");
if (isset($_GET["idsp"])) {
  $idsp = $_GET["idsp"];
  $sql = "SELECT * FROM sanpham WHERE idsp=$idsp";
  $result = $con->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <link rel="stylesheet" href="/css/sanpham.css">
  <title>Document</title>
</head>

<body>
  <?php
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc(); ?>
    <main class="container sanpham">
      <table>
        <tr>
          <td rowspan="3">
            <img src="<?php echo $row["hinhanhsp"] ?>" alt="">
          </td>
          <td>
            <strong>Tên sản phẩm</strong><br>
            <?php echo $row["tensp"] ?>
          </td>
        </tr>
        <tr>
          <td>
            <strong>Chi tiết sản phẩm</strong><br>
            <?php echo $row["chitietsp"] ?>
          </td>
        </tr>
        <tr>
          <td>
            <strong>Giá</strong><br>
            <?php echo $row["giasp"] ?>
          </td>
        </tr>
      </table>
    </main>
  <?php
  }
  ?>
</body>

</html>