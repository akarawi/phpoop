<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: ../user/login.php");
        exit;
    }
}

function checkAdmin() {
    if ($_SESSION['user']['role'] !== 'admin') {
        header("Location: ../user/welcome.php");
        exit;
    }
}
