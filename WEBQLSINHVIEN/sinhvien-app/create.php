<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'],
        $_POST['NgaySinh'], $_POST['Hinh'], $_POST['MaNganh']
    ]);
    header('Location: index.php');
    exit;
}

$nganhs = $pdo->query("SELECT * FROM NganhHoc")->fetchAll();
?>

<h2>Thêm sinh viên</h2>
<form method="post">
    Mã SV: <input name="MaSV"><br>
    Họ tên: <input name="HoTen"><br>
    Giới tính: <select name="GioiTinh">
        <option>Nam</option><option>Nữ</option>
    </select><br>
    Ngày sinh: <input name="NgaySinh" type="date"><br>
    Hình ảnh URL: <input name="Hinh"><br>
    Ngành học:
    <select name="MaNganh">
        <?php foreach ($nganhs as $ng): ?>
            <option value="<?= $ng['MaNganh'] ?>"><?= $ng['TenNganh'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Lưu</button>
</form>