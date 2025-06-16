<?php
include 'db.php';

$limit = 4;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Lấy danh sách sinh viên kèm tên ngành
$sql = "SELECT sv.*, nh.TenNganh FROM SinhVien sv 
        JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
        LIMIT $start, $limit";
$students = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Đếm tổng số sinh viên
$total = $pdo->query("SELECT COUNT(*) FROM SinhVien")->fetchColumn();
$total_pages = ceil($total / $limit);
?>

<h2>Danh sách sinh viên</h2>
<a href="create.php">➕ Thêm sinh viên</a>
<table border="1" cellpadding="8">
    <tr>
        <th>Mã SV</th><th>Họ tên</th><th>Giới tính</th>
        <th>Ngày sinh</th><th>Ngành</th><th>Ảnh</th><th>Thao tác</th>
    </tr>
    <?php foreach ($students as $sv): ?>
    <tr>
        <td><?= $sv['MaSV'] ?></td>
        <td><?= $sv['HoTen'] ?></td>
        <td><?= $sv['GioiTinh'] ?></td>
        <td><?= $sv['NgaySinh'] ?></td>
        <td><?= $sv['TenNganh'] ?></td>
        <td><img src="<?= $sv['Hinh'] ?>" width="80"></td>
        <td>
            <a href="detail.php?id=<?= $sv['MaSV'] ?>">👁</a>
            <a href="edit.php?id=<?= $sv['MaSV'] ?>">✏️</a>
            <a href="delete.php?id=<?= $sv['MaSV'] ?>" onclick="return confirm('Xóa?')">🗑</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Phân trang -->
<div>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>