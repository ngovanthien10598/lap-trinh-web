<?php
session_start();
require('./database.php');
if (!isset($_SESSION["user"])) {
  header("Location: /dang-nhap.php");
} else {
  $userid = $_SESSION["user"]["userid"];
  $sql = "SELECT idsp, tensp, chitietsp, giasp FROM sanpham WHERE idtv=$userid";
  $result = $con->query($sql);
}
require('./database.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <link rel="stylesheet" href="/css/dssp.css">
  <title>Danh sách sản phẩm</title>
</head>

<body>
  <main class="container dssp">
    <?php include("./partials/nav.php"); ?>
    <table>
      <tr>
        <th>STT</th>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
        <th>Hành động</th>
      </tr>
      <?php
      if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row["tensp"] ?></td>
            <td><?php echo $row["giasp"] ?> VND</td>
            <td>
              <form action="/xoa-san-pham.php" method="post" id="delete-form">
                <input type="hidden" name="idsp" value="<?php echo $row["idsp"] ?>">
              </form>
              <a class="button action" href="/san-pham.php?idsp=<?php echo $row["idsp"] ?>">Xem</a>
              <a class="button action" href="/sua-san-pham.php?idsp=<?php echo $row["idsp"] ?>">
                <img height="15" src="/img/edit.png" /> Sửa
              </a>
              <button class="button action" type="submit" form="delete-form">
                <img height="15" src="/img/delete.png" /> Xóa
              </button>
            </td>
          </tr>
      <?php }
      }
      ?>
    </table>
  </main>
</body>

</html>