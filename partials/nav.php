<?php
$link = $_SERVER["REQUEST_URI"];
?>

<nav class="navbar">
  <ul class="navbar-menu">
    <li><a class="navbar-link <?php echo $link == "/thong-tin-ca-nhan.php" ? "active" : "";  ?>" href="/thong-tin-ca-nhan.php">Xin chào, <strong><?php echo $_SESSION["user"]["username"] ?></strong></a></li>
    <li><a class="navbar-link <?php echo $link == "/them-san-pham.php" ? "active" : "";  ?>" href="/them-san-pham.php">Thêm sản phẩm</a></li>
    <li><a class="navbar-link <?php echo $link == "/danh-sach-san-pham.php" ? "active" : "";  ?>" href="/danh-sach-san-pham.php">Danh sách sản phẩm</a></li>
    <li><a class="navbar-link" href="/dang-xuat.php">Đăng xuất</a></li>
  </ul>
</nav>