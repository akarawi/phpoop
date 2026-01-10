<?php
include 'config/connect.php';
include 'config/Category.php';

$db = new database();
$conn = $db->getConn();
$cat = new Category($conn);

if ($_POST) {
    $cat->create($_POST['name']);
    header("Location: index.php?page=category");
    exit;
}
?>

<h3>เพิ่มหมวดหมู่</h3>

<form method="post">
    <input type="text" name="name" class="form-control mb-3" placeholder="ชื่อหมวดหมู่" required>

    <button class="btn btn-success">บันทึก</button>
</form>
