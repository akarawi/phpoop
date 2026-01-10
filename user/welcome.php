<?php
session_start();
// include '../admin/config/Auth.php';
// checkLogin();

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenGarden | ร้านขายต้นไม้ & จัดสวน</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Segoe UI", sans-serif;
}

/* สีหลักสำหรับร้านต้นไม้ */
:root {
    --primary: #2e7d32;      /* เขียวเข้มธรรมชาติ */
    --secondary: #1b5e20;    /* เขียวโทนลึก */
    --accent: #81c784;       /* เขียวอ่อนสดชื่น */
    --dark: #0f2415;         /* เขียวดำลึก คล้ายป่าชื้น */
    --gray: #e0e0e0;
    --text-light: #f5f5f5;
}

/* Header */
header {
    background: var(--dark);
    color: white;
    padding: 15px 0;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0,0,0,0.4);
}

.container {
    width: 90%;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.box {
    display: flex;
    align-items: center;
}

.container img {
    width: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.logo {
    font-size: 1.6em;
    font-weight: 700;
    color: var(--accent);
}

/* Navigation */
nav ul {
    list-style: none;
    display: flex;
    gap: 25px;
}

nav a {
    text-decoration: none;
    color: white;
    font-weight: 500;
    transition: 0.3s;
}

nav a:hover {
    color: var(--accent);
}

/* ปุ่มเมนู (มือถือ) */
.menu-toggle {
    display: none;
    font-size: 1.8em;
    color: white;
    cursor: pointer;
}

/* Hero Section */
.hero {
    background: linear-gradient(rgba(15, 36, 21, 0.75), rgba(15, 36, 21, 0.75)),
        url('../views/img/horoimg2.jpg') center/cover no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: var(--text-light);
    padding-top: 70px;
}

.hero h2 {
    font-size: 2.5em;
    margin-bottom: 15px;
    color: var(--accent);
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 25px;
    color: #d0d0d0;
}

.btn {
    display: inline-block;
    background: var(--primary);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
    transition: 0.3s;
}

.btn:hover {
    background: var(--secondary);
}

/* Services Section */
.services {
    padding: 80px 0;
    background: #f1f8f4; /* เขียวอ่อนแบบสวน */
    text-align: center;
}

.services h2 {
    font-size: 2em;
    margin-bottom: 40px;
    color: var(--dark);
}

.service-grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 30px;
}

.service-card {
    background: white;
    width: 300px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.service-card img {
    width: 80px;
    margin-bottom: 15px;
}

.service-card h3 {
    color: var(--primary);
    margin-bottom: 10px;
}

/* Product Section */
.products {
    background: #ffffff;
    padding: 80px 0;
    text-align: center;
}

.products h2 {
    color: var(--dark);
    font-size: 2em;
    margin-bottom: 10px;
}

.products .subtitle {
    color: #555;
    font-size: 1.1em;
    margin-bottom: 40px;
}

.product-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
}

.product-card {
    background: #f1f8f4;
    width: 260px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.2);
}

.product-card img {
    width: 100%;
    max-width: 200px;
    margin-bottom: 15px;
    border-radius: 8px;
}

.product-card h3 {
    color: var(--primary);
    margin-bottom: 10px;
}

/* About */
.about {
    background: var(--dark);
    color: var(--text-light);
    padding: 80px 15%;
    text-align: center;
}

.about h2 {
    font-size: 2em;
    color: var(--accent);
    margin-bottom: 20px;
}

.about p {
    font-size: 1.1em;
    color: #d7e5d4;
    line-height: 1.6em;
}

/* Contact Section */
.contact {
    background: #e8f5e9; /* เขียวอ่อนสดใส */
    padding: 80px 0;
    color: var(--dark);
}

.contact-container {
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    text-align: left;
}

.contact h2 {
    font-size: 2em;
    margin-bottom: 10px;
    color: var(--primary);
}

.info-item h3 {
    color: var(--primary);
}

/* Contact Form */
.contact-form {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.contact-form h3 {
    color: var(--primary);
    margin-bottom: 20px;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #b7c8b8;
    border-radius: 6px;
    font-size: 1em;
}

.contact-form button {
    background: var(--primary);
    color: #fff;
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 1em;
    cursor: pointer;
    transition: 0.3s;
}

.contact-form button:hover {
    background: var(--secondary);
}

/* Footer */
footer {
    background: var(--dark);
    color: var(--gray);
    text-align: center;
    padding: 15px 0;
    font-size: 0.9em;
}

/* Responsive */
@media (max-width: 768px) {
    .menu-toggle {
        display: block;
    }

    nav ul {
        position: absolute;
        top: 70px;
        right: 0;
        background: var(--dark);
        flex-direction: column;
        width: 220px;
        display: none;
        padding: 20px;
    }

    nav ul.active {
        display: flex;
    }

    .service-grid,
    .product-grid,
    .contact-info {
        flex-direction: column;
        align-items: center;
    }
}
.btn-login {
    padding: 8px 18px;
    background: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.3s;
}
.btn-login:hover {
    background: #45a049;
}

.btn-logout {
    padding: 8px 18px;
    background: #e53935;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    margin-left: 10px;
    transition: 0.3s;
}
.btn-logout:hover {
    background: #c62828;
}

.username {
    margin-right: 10px;
    font-weight: bold;
    color: var(--accent);
}

</style>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="box">
                <img src="logo_plant.png" alt="">
                <h1 class="logo">GreenGarden</h1>
            </div>

            <nav>
                <div class="menu-toggle">☰</div>
                <ul>
                    <li><a href="welcome.php">หน้าแรก</a></li>
                    <li><a href="#services">บริการ</a></li>
                    <li><a href="store.php">หน้าร้านค้า</a></li>
                    <li><a href="#about">เกี่ยวกับเรา</a></li>
                    <li><a href="#contact">ติดต่อ</a></li>
                </ul>
            </nav>

            <div class="nav-right">
                <?php if (!isset($_SESSION['user'])) : ?>
                    <!-- ยังไม่ login -->
                    <a href="login.php" class="btn-login">Login</a>
                <?php else : ?>
                    <!-- login แล้ว -->
                    <span class="username">
                        <?= htmlspecialchars($_SESSION['user']['username']) ?>
                    </span>

                    <a href="logout.php" class="btn-logout"
                       onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');">
                        Logout
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h2>ช่วยให้บ้านและพื้นที่ของคุณสดชื่นขึ้น</h2>
            <p>ร้านขายต้นไม้คุณภาพ พร้อมบริการจัดสวน ตกแต่งบ้าน และดูแลต้นไม้รายเดือน</p>
            <a href="#services" class="btn">ดูบริการของเรา</a>
        </div>
    </section>

    <!-- Services -->
    <section id="services" class="services">
        <h2>บริการของเรา</h2>
        <div class="service-grid">
            <div class="service-card">
                <h3>ดูแลต้นไม้</h3>
                <p>ให้บริการดูแลต้นไม้ เปลี่ยนดิน ตัดแต่งกิ่ง และให้คำปรึกษาแบบมืออาชีพ</p>
            </div>
            <div class="service-card">
                <h3>ออกแบบ & จัดสวน</h3>
                <p>บริการออกแบบสวนภายในบ้าน คอนโด และสำนักงาน</p>
            </div>
            <div class="service-card">
                <h3>ส่งต้นไม้ถึงบ้าน</h3>
                <p>ส่งต้นไม้หลากหลายชนิดทั่วประเทศ แพ็คอย่างดี</p>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section id="products" class="products">
        <h2>ต้นไม้ยอดนิยม</h2>
        <p class="subtitle">คัดสรรต้นไม้คุณภาพดี</p>

        <div class="product-grid">
            <div class="product-card">
                <h3>มอนสเตอร่า</h3>
                <p>เพิ่มความหรูหราให้บ้านและคาเฟ่</p>
            </div>
            <div class="product-card">
                <h3>ลิ้นมังกร</h3>
                <p>ฟอกอากาศดี เหมาะกับห้องนอน</p>
            </div>
            <div class="product-card">
                <h3>ไทรใบสัก</h3>
                <p>สไตล์มินิมอล ดูแลง่าย</p>
            </div>
            <div class="product-card">
                <h3>กระบองเพชร</h3>
                <p>โตช้า ดูแลง่าย</p>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="about">
        <h2>เกี่ยวกับเรา</h2>
        <p>
            GreenGarden ร้านขายต้นไม้และบริการจัดสวนครบวงจร
            ด้วยประสบการณ์มากกว่า 10 ปี
        </p>
    </section>

    <!-- Contact -->
    <section id="contact" class="contact">
        <div class="contact-container">
            <h2>ติดต่อเรา</h2>

            <div class="contact-info">
                <div class="info-item">
                    <h3>ร้าน GreenGarden</h3>
                    <p>234/5 จังหวัดกำแพงเพชร</p>
                </div>
                <div class="info-item">
                    <h3>ช่องทางติดต่อ</h3>
                    <p>โทร: 080-123-4567</p>
                    <p>Email: greengarden@shop.com</p>
                </div>
            </div>

            <form class="contact-form">
                <h3>ส่งข้อความถึงเรา</h3>
                <input type="text" placeholder="ชื่อของคุณ" required>
                <input type="email" placeholder="อีเมลของคุณ" required>
                <textarea rows="5" placeholder="เขียนข้อความที่นี่..." required></textarea>
                <button type="submit">ส่งข้อความ</button>
            </form>
        </div>
    </section>

    <footer>
        <p>© 2025 GreenGarden | All Rights Reserved</p>
    </footer>

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.querySelector('nav ul');

        menuToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>

