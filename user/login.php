<?php
session_start();
include '../admin/config/connect.php';
include '../admin/config/Login.php';

$db = new database();
$conn = $db->getConn();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    //ไม่พบผู้ใช้
    if (!$user) {
        echo "<script>alert('Email or password incorrect');</script>";
    }
    //ถูกแบน
    elseif ($user['status'] !== 'Active') {
        echo "<script>alert('คุณถูกแบน ไม่สามารถเข้าสู่ระบบได้');</script>";
    }
    //รหัสผ่านผิด
    elseif (!password_verify($password, $user['password'])) {
        echo "<script>alert('Email or password incorrect');</script>";
    }
    //ผ่านทุกอย่าง
    else {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'fname' => $user['fname'],
            'lname' => $user['lname'],
            'role' => $user['role']
        ];

        if ($user['role'] === 'admin') {
            header("Location: ../admin/index.php");
        } else {
            header("Location: welcome.php");
        }
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
    * {
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        margin: 0;
        height: 100vh;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        width: 100%;
        max-width: 380px;
        padding: 20px;
    }

    .login-form {
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .login-form h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .login-form input {
        width: 100%;
        padding: 12px 14px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 14px;
        transition: 0.3s;
    }

    .login-form input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2);
    }

    .login-form button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: #667eea;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .login-form button:hover {
        background: #556cd6;
    }

    .imguserlogin {
        width: 100px;
        height: 100px;
        border: solid 2px;
        border-radius: 100%;
    }

    .blockimg {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .blockregister{
        display: flex;
        justify-content: space-around;
        align-items: center;
        
    }

</style>

<body>
    <div class="login-container">
        <form method="post" class="login-form">
            <h2>Login</h2>
            <div class="blockimg">
                <img class="imguserlogin" src="../admin/image/login.jpg" alt="">
            </div>
            <input name="email" type="email" placeholder="Email">
            <input name="password" type="password" placeholder="Password">

            <button type="submit">Login</button>
            <div class="blockregister">
                <p>Dont have an account?</p>
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>

</body>

</html>