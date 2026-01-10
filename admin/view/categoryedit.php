<?php
include 'config/connect.php';
include 'config/Category.php';

$db = new database();
$conn = $db->getConn();
$cat = new Category($conn);

$data = $cat->find((int)$_GET['id']);

if ($_POST) {
    $cat->update($_GET['id'], $_POST['name']);
    header("Location: index.php?page=category");
    exit;
}
?>

<h3>แก้ไขหมวดหมู่</h3>

<form method="post">
    <input type="text" name="name" class="form-control mb-3"
           value="<?= htmlspecialchars($data['name']) ?>" required>

    <button class="btn btn-primary">อัปเดต</button>
</form>
