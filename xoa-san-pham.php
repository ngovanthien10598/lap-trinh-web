<?php
session_start();
require("./database.php");
if (!isset($_SESSION["user"])) {
  header("Location: /dang-nhap.php");
} else {
  if (isset($_POST["idsp"])) {
    $idsp = $_POST["idsp"];
    $sql = "DELETE FROM sanpham WHERE idsp=$idsp";
    if($con->query($sql)) {
      header("Location: /danh-sach-san-pham.php");
    }
  }
}