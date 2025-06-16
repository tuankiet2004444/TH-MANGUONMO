<?php
include 'db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh WHERE MaSV = ?");
$stmt->execute([$id]);
$sv = $stmt->fetch();
?>

<h2>Chi tiết sinh viên</h2>
<p>Mã: <?= $sv['MaSV'] ?></p>
<p>Họ tên: <?= $sv['HoTen'] ?></p>
<p>Giới tính: <?= $sv['GioiTinh'] ?></p>
<p>Ngày sinh: <?= $sv['NgaySinh'] ?></p>
<p>Ngành: <?= $sv['TenNganh'] ?></p>
<img src="<?= $sv['Hinh'] ?>" width="200">
<br><a href="index.php">⬅ Quay lại</a>