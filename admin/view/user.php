<?php
include 'config/User.php';
include 'config/connect.php';

$db = new database();
$conn = $db->getConn();
$user = new User($conn);
$result = $user->getAllUser();

$type = $_GET['type'] ?? '';

if ($type === 'admin') {
    $result = $conn->query("SELECT * FROM users WHERE role='admin'");
} elseif ($type === 'user') {
    $result = $conn->query("SELECT * FROM users WHERE role='user'");
} elseif ($type === 'banned') {
    $result = $conn->query("SELECT * FROM users WHERE status='Banned'");
} else {
    $result = $user->getAllUser();
}


// ลบผู้ใช้
if (isset($_GET['delete'])) {
    $user->delete($_GET['delete']);
    header("Location: index.php?page=user");
    exit;
}

// เปลี่ยนสถานะ
if (isset($_GET['changeStatus'])) {
    $user->changeStatus($_GET['changeStatus']);
    header("Location: index.php?page=user");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h3 mb-0">
        <i class="bi bi-people-fill text-success me-2"></i>
        ระบบจัดการผู้ใช้งาน
    </h1>

    <div>
        <a href="index.php?page=user&type=user" class="btn btn-success shadow-sm">
            ดูรายการ User
        </a>

        <a href="index.php?page=user&type=admin" class="btn btn-primary shadow-sm">
            ดูรายการ Admin
        </a>

        <a href="index.php?page=user&type=banned" class="btn btn-danger shadow-sm">
            ดูรายการที่ถูกแบน
        </a>

    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-semibold">
    <?php
        if ($type === 'admin') {
            echo "รายชื่อผู้ดูแลระบบ (Admin)";
        } elseif ($type === 'user') {
            echo "รายชื่อผู้ใช้งานปกติ (User)";
        } elseif ($type === 'banned') {
            echo "รายชื่อผู้ใช้งานที่ถูกแบน";
        } else {
            echo "รายชื่อผู้ใช้งานทั้งหมด";
        }
    ?>
</div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>การติดต่อ</th>
                        <th>สิทธิ์</th>
                        <th>สถานะ</th>
                        <th class="text-center" width="22%">จัดการ</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="ps-4 text-muted">#<?= (int) $row['id'] ?></td>

                                <td>
                                    <div class="fw-semibold">
                                        <?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?>
                                    </div>
                                    <small class="text-secondary">
                                        <i class="bi bi-person-circle me-1"></i>@<?= htmlspecialchars($row['username']) ?>
                                    </small>
                                </td>

                                <td>
                                    <div class="small">
                                        <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($row['email']) ?>
                                    </div>
                                    <div class="small">
                                        <i class="bi bi-telephone me-1"></i><?= htmlspecialchars($row['phonenumber']) ?>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge rounded-pill 
                                    <?= $row['role'] === 'admin' ? 'bg-primary' : 'bg-info text-dark' ?>">
                                        <?= strtoupper(htmlspecialchars($row['role'])) ?>
                                    </span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill
                                        <?= $row['status'] === 'Active' ? 'bg-success' : 'bg-danger' ?>">
                                        <?= ucfirst(htmlspecialchars($row['status'])) ?>
                                    </span>


                                </td>

                                <td class="text-center pe-4">
                                    <div class="btn-group">
                                        <!-- แก้ไข -->
                                        <a href="index.php?page=useredit&id=<?= (int) $row['id'] ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i> แก้ไขข้อมูล
                                        </a>

                                        <!-- เปลี่ยนสถานะ -->
                                        <a href="index.php?page=user&changeStatus=<?= (int) $row['id'] ?>"
                                            class="btn btn-sm btn-outline-warning"
                                            onclick="return confirm('ต้องการเปลี่ยนสถานะผู้ใช้งานนี้หรือไม่?');">
                                            <i class="bi bi-power"></i> เปลี่ยนสถานะ
                                        </a>

                                        <!-- ลบ -->
                                        <a href="index.php?page=user&delete=<?= (int) $row['id'] ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('ยืนยันการลบผู้ใช้งานนี้หรือไม่?');">
                                            <i class="bi bi-trash"></i> ลบผู้ใช้
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                ไม่พบข้อมูลผู้ใช้งาน
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>