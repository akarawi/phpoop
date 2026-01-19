<?php
include 'config/connect.php';
include 'config/Product.php';

$db = new database();
$conn = $db->getConn();
$product = new Product($conn);
$categoryId = $_GET['category'] ?? '';

if ($_POST) {
    $data = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'category_id' => $_POST['category_id'],
        'image' => $_POST['image'] ?? null
    ];

    $product->create($data);
    header("Location: index.php?page=product&category=" . $categoryId);
    exit;
}
?>

<h3>เพิ่มสินค้า</h3>

<form form method="post" enctype="multipart/form-data">
    <div class="mb-2">
        <label>ชื่อสินค้า</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>รายละเอียด</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="mb-2">
        <label>ราคา</label>
        <input type="number" step="0.01" name="price" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>สต็อก</label>
        <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>หมวดหมู่</label>
        <input type="number" name="category_id" class="form-control" value="<?= htmlspecialchars($categoryId) ?>"
            required>
    </div>

    <div class="mb-2">
        <label>รูปภาพ</label>
        <input type="file" name="image" class="form-control">
    </div>


    <button class="btn btn-success mt-2">บันทึก</button>
</form>