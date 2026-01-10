<nav class="navbar navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-leaf-fill me-2"></i>Green Gradient
        </a>

        <div class="ms-auto">
            <?php if (!isset($_SESSION['user'])) : ?>
                <a href="login.php" class="btn btn-outline-light px-4">
                    Login
                </a>
            <?php else : ?>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        <i class="bi bi-person-circle me-1"></i>
                        <strong><?= htmlspecialchars($_SESSION['user']['username']) ?></strong>
                    </span>
                    
                    <a href="../user/logout.php" class="btn btn-danger btn-sm px-3"
                       onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');">
                        Logout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</nav>