<?php
include '../admin/config/connect.php';
include '../admin/config/Product.php';
include '../admin/config/Category.php';

$db = new database();
$conn = $db->getConn();

$product = new Product($conn);
$category = new Category($conn);

// ดึงหมวดหมู่ทั้งหมด
$categories = $category->getAll();

// รับ category จาก URL
$category_id = $_GET['category'] ?? null;

// ดึงสินค้า
if ($category_id) {
    $products = $product->getByCategory($category_id);
} else {
    $products = $product->getAll();
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>GreenGarden | Demo Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-gradient-to-br from-green-50 to-emerald-100">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white fixed top-0 w-full shadow-lg z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

            <div class="flex items-center gap-2">
                <span class="font-bold text-green-400 text-xl">GreenGarden</span>
            </div>

            <ul class="hidden md:flex gap-8">
                <li><a href="welcome.php" class="hover:text-green-400">หน้าแรก</a></li>
                <li><a href="#" class="text-green-400">หน้าร้านค้า</a></li>
                <li><a href="#" class="hover:text-green-400">ติดต่อ</a></li>
            </ul>

            <i class="bi bi-cart-fill text-2xl"></i>
        </div>
    </nav>

    <div class="pt-28"></div>

    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-green-700 mb-2">
            ร้านต้นไม้ GreenGarden
        </h1>
    </div>

    <!-- Category -->
    <div class="flex justify-center mb-10">
        <select onchange="location = this.value" class="px-6 py-3 rounded-full shadow border">

            <option value="store.php">แสดงทั้งหมด</option>

            <?php foreach ($categories as $cat): ?>
                <option value="store.php?category=<?= $cat['id'] ?>" <?= ($category_id == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>

    <!-- Products -->
    <div class="max-w-7xl mx-auto px-6 pb-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php if (empty($products)): ?>
            <p class="col-span-full text-center text-gray-500">
                ไม่มีสินค้าในหมวดหมู่นี้
            </p>
        <?php endif; ?>

        <?php foreach ($products as $p): ?>
            <div class="bg-white rounded-3xl shadow-lg hover:-translate-y-2 transition overflow-hidden">

                <img src="admin/image/<?= htmlspecialchars($p['image']) ?>"
                    class="w-full h-56 object-cover hover:scale-110 transition duration-500">

                <div class="p-5">
                    <h3 class="font-bold text-lg">
                        <?= htmlspecialchars($p['name']) ?>
                    </h3>

                    <p class="text-green-600 font-extrabold text-xl my-2">
                        <?= number_format($p['price']) ?> บาท
                    </p>

                    <div class="flex gap-3">
                        <button class="flex-1 py-2 border border-green-600 text-green-600 rounded-full
                           hover:bg-green-600 hover:text-white transition">
                            Buy now
                        </button>

                        <button class="flex-1 py-2 bg-green-600 text-white rounded-full
                           hover:bg-green-700 transition">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>


    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 text-center py-6">
        © 2025 GreenGarden | Demo UI Only
    </footer>

</body>

</html>