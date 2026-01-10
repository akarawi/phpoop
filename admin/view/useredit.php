<?php
include 'config/User.php';
include 'config/connect.php';

$db = new database();
$conn = $db->getConn();
$user = new User($conn);

// รับ id
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?page=user");
    exit;
}

$userData = $user->getById($id);

// เมื่อกดบันทึก
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = [
        'id'          => $id,
        'fname'       => $_POST['fname'],
        'lname'       => $_POST['lname'],
        'email'       => $_POST['email'],
        'phonenumber' => $_POST['phonenumber'],
        'role'        => $_POST['role'],
        'status'      => $_POST['status'],
    ];

    if ($user->update($data)) {
        header("Location: index.php?page=user");
        exit;
    }

    $error = "เกิดข้อผิดพลาด ไม่สามารถบันทึกข้อมูลได้";
}
?>

<div class="card shadow-sm border-0">
    <div class="card-header fw-semibold bg-white">
        แก้ไขข้อมูลผู้ใช้งาน
    </div>

    <div class="card-body">
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" name="fname" class="form-control"
                           value="<?= htmlspecialchars($userData['fname']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">นามสกุล</label>
                    <input type="text" name="lname" class="form-control"
                           value="<?= htmlspecialchars($userData['lname']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">อีเมล</label>
                    <input type="email" name="email" class="form-control"
                           value="<?= htmlspecialchars($userData['email']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">เบอร์โทร</label>
                    <input type="text" name="phonenumber" class="form-control"
                           value="<?= htmlspecialchars($userData['phonenumber']) ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label">สิทธิ์</label>
                    <select name="role" class="form-select">
                        <option value="user"  <?= $userData['role'] === 'user' ? 'selected' : '' ?>>User</option>
                        <option value="admin" <?= $userData['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">สถานะ</label>
                    <select name="status" class="form-select">
                        <option value="Active" <?= $userData['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Banned" <?= $userData['status'] === 'Banned' ? 'selected' : '' ?>>Banned</option>
                    </select>
                </div>

            </div>

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-success">บันทึก</button>
                <a href="index.php?page=user" class="btn btn-secondary">กลับ</a>
            </div>
        </form>
    </div>
</div>
