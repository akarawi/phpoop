<?php
include 'config/connect.php';
include 'config/Product.php';

$db = new database();
$conn = $db->getConn();
$productObj = new Product($conn);

$id = $_GET['id'];
$product = $productObj->getById($id)->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // ถ้าไม่ได้อัปโหลดใหม่ → ใช้รูปเดิม
    $image = $product['image'];

    if (!empty($_FILES['image']['name'])) {
        $image = $productObj->uploadImage($_FILES['image']);
    }

    $data = [   
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'category_id' => $_POST['category_id'],
        'image' => $image
    ];

    if ($productObj->update($id, $data)) {
        header("Location: index.php?page=product");
        exit;
    } else {
        echo "<div class='alert alert-danger'>แก้ไขไม่สำเร็จ</div>";
    }
}
?>

<h4>แก้ไขสินค้า</h4>

<form method="post" enctype="multipart/form-data">

    <div class="mb-2">
        <label>ชื่อสินค้า</label>
        <input name="name" class="form-control" value="<?= $product['name'] ?>">
    </div>

    <div class="mb-2">
        <label>รายละเอียด</label>
        <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
    </div>

    <div class="mb-2">
        <label>ราคา</label>
        <input name="price" class="form-control" value="<?= $product['price'] ?>">
    </div>

    <div class="mb-2">
        <label>สต็อก</label>
        <input name="stock" class="form-control" value="<?= $product['stock'] ?>">
    </div>

    <div class="mb-2">
        <label>หมวดหมู่</label>
        <input name="category_id" class="form-control" value="<?= $product['category_id'] ?>">
    </div>

    <div class="mb-2">
        <label>รูปเดิม</label><br>
        <img src="./image/<?= $product['image'] ?>" alt="">
    </div>

    <div class="mb-2">
        <label>เลือกรูปใหม่ (ถ้าจะเปลี่ยน)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-primary">บันทึก</button>
</form>
