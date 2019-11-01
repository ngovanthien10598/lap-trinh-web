<?php
session_start();
require('./database.php');
$message = "";
if (isset($_POST["username"],
$_POST["password"],
$_POST["confirmPassword"],
$_FILES["avatar"],
$_POST["gender"],
$_POST["job"],
$_POST["favourite"])) {
  $tendangnhap = $_POST["username"];
  $matkhau = $_POST["password"];
  $nhaplaimatkhau = $_POST["confirmPassword"];
  $avatar = $_FILES["avatar"];
  $gioitinh = $_POST["gender"];
  $nghenghiep = $_POST["job"];
  $sothich = $_POST["favourite"];


  $fileName = $avatar["name"];
  $avatarLink = '/public/' . $fileName;
  $uploadPath = '.' . $avatarLink;

  if (move_uploaded_file($avatar["tmp_name"], $uploadPath)) {
    $sothich_string = implode(", ", $sothich);
    $sql = "INSERT INTO thanhvien(tendangnhap, matkhau, hinhanh, gioitinh, nghenghiep, sothich)
            VALUES('$tendangnhap', '" . md5($matkhau) . "', '$avatarLink', '$gioitinh', '$nghenghiep', '$sothich_string')";

    if ($con->query($sql)) {
      $_SESSION["user"] = ["username" => $tendangnhap];
      $message = "Đăng ký tài khoản thành công";
    } else {
        die("Co loi xay ra");
    }
  } else {
      die("Loi khi upload file");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("./partials/head.php") ?>
  <title>Đăng ký</title>
</head>

<body>
  <div class="wrapper">
    <main class="container">
      <form action="/dang-ky.php" method="post" enctype="multipart/form-data" class="form" onsubmit="return validateForm()" name="sign-up-form">
        <h1 class="form-title">Đăng ký</h1>
        <?php
        if (strlen($message) > 0) { ?>
          <p class="message success"><?php echo $message ?></p>
        <?php }
        ?>
        <table>
          <!-- Tên đăng nhập -->
          <tr id="username-row">
            <td>Tên đăng nhập</td>
            <td>
              <input class="form-control" type="text" name="username" required>
              <p class="form-error"><small>Bắt đầu bằng chữ cái, 6-15 ký tự, gồm chữ và số</small></p>
            </td>
          </tr>

          <!-- Mật khẩu -->
          <tr id="password-row">
            <td>Mật khẩu</td>
            <td>
              <input class="form-control" type="password" name="password" required>
              <p class="form-error"><small>Chỉ bao gồm chữ cái và số, từ 6-15 ký tự</small></p>
            </td>
          </tr>

          <!-- Nhập lại mật khẩu -->
          <tr id="confirm-password-row">
            <td>Nhập lại mật khẩu</td>
            <td>
              <input class="form-control" type="password" name="confirmPassword" required/>
              <p class="form-error"><small>Mật khẩu không trùng khớp</small></p>
            </td>
          </tr>

          <!-- Ảnh đại diện -->
          <tr>
            <td>Ảnh đại diện</td>
            <td>
              <input class="form-control" type="file" name="avatar" accept="image/*" required>
            </td>
          </tr>

          <!-- Giới tính -->
          <tr>
            <td>Giới tính</td>
            <td>
              <input type="radio" name="gender" value="Nam"> Nam
              <input type="radio" name="gender" value="Nữ"> Nữ
              <input type="radio" name="gender" value="Khác" checked> Khác
            </td>
          </tr>

          <!-- Nghề nghiệp -->
          <tr>
            <td>Nghề nghiệp</td>
            <td>
              <select name="job" class="form-control">
                <option value="Học sinh">Học sinh</option>
                <option value="Sinh viên">Sinh viên</option>
                <option value="Giáo viên">Giáo viên</option>
              </select>
            </td>
          </tr>

          <!-- Sở thích -->
          <tr>
            <td>Sở thích</td>
            <td>
              <input type="checkbox" name="favourite[]" value="Thể thao"> Thể thao
              <input type="checkbox" name="favourite[]" value="Du lịch"> Du lịch
              <br>
              <input type="checkbox" name="favourite[]" value="Âm nhạc"> Âm nhạc
              <input type="checkbox" name="favourite[]" value="Thời trang"> Thời trang
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <button class="button" type="submit">Đăng ký</button>
              <button class="button" type="reset">Làm lại</button>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>Đã có tài khoản? <a href="/dang-nhap.php">Đăng nhập</a></td>
          </tr>
        </table>
      </form>
    </main>
  </div>

  <script>
    function validateForm() {
      let error = {
        username: false,
        password: false,
        confirmPassword: false
      };

      // Select all DOMs have to validate
      const usernameRow = document.querySelector("#username-row");
      const passwordRow = document.querySelector("#password-row");
      const confirmPasswordRow = document.querySelector("#confirm-password-row");

      // Remove all errors
      usernameRow.classList.remove("error");
      passwordRow.classList.remove("error");
      confirmPasswordRow.classList.remove("error");

      const usernameReg = /^[a-zA-Z][a-zA-Z0-9]{5,15}$/g;
      const passwordReg = /^(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9]{6,15}$/g;

      const signUpForm = document.forms["sign-up-form"];
      const formElements = signUpForm.elements;

      const username = formElements["username"].value;
      const password = formElements["password"].value;
      const confirmPassword = formElements["confirmPassword"].value;

      if (!usernameReg.test(username)) {
        error.username = true;
        usernameRow.classList.add("error");
      }

      if (!passwordReg.test(password)) {
        error.password = true;
        passwordRow.classList.add("error");
      }

      if (confirmPassword !== password) {
        error.confirmPassword = true;
        confirmPasswordRow.classList.add("error");
      }

      return !(error.username || error.password || error.confirmPassword);
    }
  </script>
</body>

</html>