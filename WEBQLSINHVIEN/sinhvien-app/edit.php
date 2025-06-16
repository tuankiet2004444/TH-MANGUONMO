<?php
include 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM SinhVien WHERE MaSV = ?");
$stmt->execute([$id]);
$sv = $stmt->fetch();

$nganhs = $pdo->query("SELECT * FROM NganhHoc")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE SinhVien SET HoTen=?, GioiTinh=?, NgaySinh=?, Hinh=?, MaNganh=? WHERE MaSV=?");
    $stmt->execute([
        $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $_POST['Hinh'],
        $_POST['MaNganh'], $id
    ]);
    header('Location: index.php');
    exit;
}
?>

<h2>Sửa sinh viên</h2>
<form method="post">
    Họ tên: <input name="HoTen" value="<?= $sv['HoTen'] ?>"><br>
    Giới tính: <select name="GioiTinh">
        <option <?= $sv['GioiTinh'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
        <option <?= $sv['GioiTinh'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
    </select><br>
    Ngày sinh: <input name="NgaySinh" type="date" value="<?= $sv['NgaySinh'] ?>"><br>
    Hình ảnh URL: <input name="Hinh" value="<?= $sv['Hinh'] ?>"><br>
    Ngành học:
    <select name="MaNganh">
        <?php foreach ($nganhs as $ng): ?>
            <option value="<?= $ng['MaNganh'] ?>" <?= $sv['MaNganh'] == $ng['MaNganh'] ? 'selected' : '' ?>>
                <?= $ng['TenNganh'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Cập nhật</button>
</form>