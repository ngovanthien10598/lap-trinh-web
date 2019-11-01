<?php
session_start();
if (!isset($_SESSION["user"], $_SESSION["user"]["userid"])) {
    header('Location: /dang-nhap.php');
} else {
    require('../../database.php');
    $sql = "SELECT tensp, hinhanhsp FROM sanpham WHERE idtv=" . $_SESSION["user"]["userid"];
    $result = $con->query($sql);
    $allResult = $result->fetch_all();
}
?>


<!DOCTYPE html>
<html>

<head>
	<title> Lập trình web (CT428) </title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" type="text/css" href="/buoi-4/bai-2/style.css" media="screen" />
</head>

<body onload="enableButtons()">
	<div id="wrap">
		<div id="title">
			<h1 class="title">Bài 4 - Buổi 4</h1>
		</div>
		<!--end div title-->
		<!--end div menu-->
		<div id="content">
			<!--Nội dung trang web-->
			<h1 class="sub-heading">Slide show</h1>

            <?php if (sizeof($allResult) > 0) { ?>
			<form>
				<img id="laptopImg" class="laptop-img" src="<?php echo $allResult[0][1] ?>" height="300" width="300" />
				<!-- Preload (for performance) -->
				<br />
				<div class="controls">
					<button type="button" class="button" onclick="previousSlide()" disabled>&lt;</button>
					<button type="button" class="button" onclick="nextSlide()" disabled>&gt;</button>
				</div>
				<br />
				<select name="laptopSel" class="laptop-select" id="laptop-select" onchange="selectSlide(value)">
				    <?php
				    foreach($allResult as $key => $value) { ?>
					<option value="<?php echo $key ?>"><?php echo $value[0] ?></option>
					<?php } ?>
				</select>
			</form>
			<?php } else { ?>
			    <p>Bạn chưa có sản phẩm nào, vui lòng thêm sản phẩm tại <a href="/them-san-pham.php">đây</a></p>
			<?php } ?>
			<div class="requirement">
				<p>Cải tiến bài 2 để các hình ảnh hiển thị là các hình ảnh lấy ra từ bảng sanpham của người dùng đã đăng nhập.</p>
				
<p>Giải thích: Chọn Buổi 3 - Bài 2 để đăng nhập (đã thực hiện ở buổi 3). Nếu đăng nhập thành công thì khi chọn Buổi 4 - Bài 4 mới có thể xem hình ảnh các sản phẩm của mình theo quy cách của Buổi 4 - Bài 2.</p>
			</div>
		</div>
		<!--end div content-->
		<div id="footer">
			<p>Họ tên SV: Ngô Văn Thiện<br /> Email: thienb1607030@student.ctu.edu.vn</p>
			<p><a href="/">Về trang chủ</a></p>
		</div>
		<!--end div footer-->
	</div>
	<!--end div wrap-->

	<script>
		// bai tap co nhieu cach lam, code trong tap tin nay chi la vi du ve 1 trong nhung cach lam de sinh vien tham khao
		const IMAGE_PATHS = [];
		<?php
		 foreach($allResult as $key => $value) {
echo "IMAGE_PATHS[$key] = '$value[1]';" . "\n";
		 }
		?>

		const imgTag = document.querySelector('#laptopImg');
		const laptopSelect = document.querySelector('#laptop-select');

		let currentSlide = 0;

		function previousSlide() {
			currentSlide = (currentSlide - 1 + IMAGE_PATHS.length) % IMAGE_PATHS.length;
			setImage(currentSlide);
			selectIndex(currentSlide);
		}

		function nextSlide() {
			currentSlide = (currentSlide + 1) % IMAGE_PATHS.length;
			setImage(currentSlide);
			selectIndex(currentSlide);
		}

		function selectSlide(index) {
			currentSlide = index;
			setImage(currentSlide);
		}

		function setImage(index) {
			imgTag.setAttribute('src', IMAGE_PATHS[currentSlide]);
		}

		function selectIndex(index) {
			laptopSelect.selectedIndex = index;
		}

		function enableButtons() {
			const buttons = document.querySelectorAll(".button");
			buttons.forEach(button => {
				button.removeAttribute('disabled');
			})
		}
	</script>
</body>

</html>