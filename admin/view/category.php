<?php
include 'config/connect.php';
include 'config/Category.php';

$db = new database();
$conn = $db->getConn();
$cat = new Category($conn);
$result = $cat->getAll();



if (isset($_GET['delete'])) {
    $cat->delete((int) $_GET['delete']);
    header("Location: index.php?page=category");
    exit;
}

?>

<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 mb-0">จัดการหมวดหมู่สินค้า</h1>

    <a href="index.php?page=categoryadd" class="btn btn-success">
        + เพิ่มหมวดหมู่
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-semibold">
        รายชื่อหมวดหมู่ทั้งหมด
    </div>

    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">ID</th>
                    <th>ชื่อหมวดหมู่</th>
                    <th class="text-center" width="20%">จัดการ</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="ps-4">#<?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>

                        <td class="text-center">
                            <a href="index.php?page=product&category=<?= (int) $row['id'] ?>"
                                class="btn btn-sm btn-outline-success">
                                ดูรายการสินค้า
                            </a>


                            <a href="index.php?page=categoryedit&id=<?= $row['id'] ?>"
                                class="btn btn-sm btn-outline-primary">แก้ไข</a>

                            <a href="index.php?page=category&delete=<?= $row['id'] ?>"
                                onclick="return confirm('ยืนยันการลบ?')" class="btn btn-sm btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>