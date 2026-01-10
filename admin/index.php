<?php
session_start();

if (isset($_SESSION['user'])) {
    // login แล้ว
    if ($_SESSION['user']['role'] === 'admin') {
        // เป็น admin
        // อยู่หน้าเดิม
    } else {
        header("Location: ../user/welcome.php");
    }
} else {
    // ยังไม่ login
    header("Location: ../user/welcome.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-md-2 bg-dark min-vh-100 p-0">
                <?php include 'sidebar.php'; ?>
            </div>

            <!-- Content -->
            <main class="col-md-10 p-4">
                <?php
                if (!isset($_GET['page'])) {
                    // หน้าแรก
                    include 'content.php';
                } else {
                    $page = $_GET['page'];

                    // หน้าในโฟลเดอร์ view
                    $allowedPages = [];

                    foreach (scandir("view") as $file) {
                        // เอาเฉพาะไฟล์ .php เท่านั้น
                        if (pathinfo($file, PATHINFO_EXTENSION) === "php") {
                            $allowedPages[] = pathinfo($file, PATHINFO_FILENAME);
                        }
                    }   


                    if (in_array($page, $allowedPages)) {
                        include "view/$page.php";
                    } else {
                        echo "<h4 class='text-danger'>404 Page not found</h4>";
                    }
                }
                ?>
            </main>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>