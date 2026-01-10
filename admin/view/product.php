<?php
include 'config/connect.php';
include 'config/Product.php';

$db = new database();
$conn = $db->getConn();
$product = new Product($conn);

$categoryId = $_GET['category'] ?? null;

if ($categoryId) {
    $result = $conn->query(
        "SELECT * FROM products WHERE category_id = " . (int)$categoryId
    );
} else {
    $result = $conn->query("SELECT * FROM products");
}


// delete
if(isset($_GET['delete'])){
    $product->delete((int)$_GET['delete']);
    header("Location: index.php?page=product");
    exit;
}

?>

<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 mb-0">จัดการสินค้า</h1>

    <a href="index.php?page=productadd" class="btn btn-success">
        + เพิ่มสินค้า
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white fw-semibold">รายการสินค้า</div>

    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
            <tr>
                <th class="ps-4">ID</th>
                <th>ชื่อสินค้า</th>
                <th>ราคา</th>
                <th>สต็อก</th>
                <th>หมวดหมู่</th>
                <th class="text-center" width="20%">จัดการ</th>
            </tr>
            </thead>

            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td class="ps-4"><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td><?= $row['category_id'] ?></td>

                    <td class="text-center">
                        <a href="index.php?page=productedit&id=<?= $row['id'] ?>"
                           class="btn btn-sm btn-outline-primary">แก้ไข</a>

                        <a href="index.php?page=product&delete=<?= $row['id'] ?>"
                           onclick="return confirm('ยืนยันการลบสินค้า?')"
                           class="btn btn-sm btn-outline-danger">ลบ</a>
                    </td>
                </tr>
            <?php endwhile;?>
            </tbody>
        </table>
    </div>
</div>
