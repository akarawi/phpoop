<?php
include '../admin/config/connect.php';
include '../admin/config/Register.php';

$db = new database();
$conn = $db->getConn();
$register = new Register($conn);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // 1️⃣ ตรวจ password ตรงกันไหม
    if ($password !== $confirm_password) {
        $error = "Password และ Confirm Password ไม่ตรงกัน";
    } else {

        // 2️⃣ ตรวจ email ซ้ำ
        $checkSql = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            $error = "Email นี้ถูกใช้งานแล้ว";
        } else {

            // 3️⃣ insert ได้
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'user';
            $status = 'active';
            $now = date('Y-m-d H:i:s');

            $sql = "INSERT INTO users
                (username, fname, lname, phonenumber, email, password, role, status, created_at)
                VALUES (?,?,?,?,?,?,?,?,?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssssss",
                $username,
                $fname,
                $lname,
                $phone,
                $email,
                $hashed_password,
                $role,
                $status,
                $now
            );

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                $error = "เกิดข้อผิดพลาด กรุณาลองใหม่";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<style>
    * {
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-container {
        width: 100%;
        max-width: 420px;
        padding: 20px;
    }

    .register-form {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .register-form h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .register-form input {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: 0.3s;
    }

    .register-form input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.25);
    }

    .register-form button {
        width: 100%;
        padding: 13px;
        border: none;
        border-radius: 8px;
        background: #764ba2;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .register-form button:hover {
        background: #5e3b8a;
    }

    .error-message {
        background: #ffe0e0;
        color: #b30000;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
        text-align: center;
        font-size: 14px;
    }

    .blocklogin{
        margin-top: 10px;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }
</style>

<body>
    <div class="register-container">
        <form method="post" class="register-form">
            <h2>Register</h2>

            <?php if (!empty($error)): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>

            <input name="username" placeholder="Username" required>
            <input name="fname" placeholder="First name" required>
            <input name="lname" placeholder="Last name" required>
            <input name="phonenumber" placeholder="Phone" required>
            <input name="email" type="email" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <input name="confirm_password" type="password" placeholder="Confirm Password" required>

            <button type="submit">Register</button>
            <div class="blocklogin">
                <p>You have an account?</p>
                <a href="login.php">Login</a>
            </div>
        </form>

    </div>

</body>

</html>