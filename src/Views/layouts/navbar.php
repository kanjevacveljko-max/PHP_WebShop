<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand fw-bold" href="index.php">💻 WebShop</a>

        <form class="d-none d-lg-flex position-absolute top-50 start-50 translate-middle"
              role="search" action="/webshop/index.php" method="get" style="width: 300px; transform: translate(-50%, -50%);">
            <input type="hidden" name="action" value="search">
            <input class="form-control me-2" type="search" name="q" placeholder="Search products..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>

        <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'):?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=adminDashboard">Dashboard</a>
                        </li>

                <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=cart">Cart 🛒</a>
                        </li>

                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link" href="src/Views/Users/profile.php">
                        <?= htmlspecialchars($_SESSION["fullName"]) ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=logout">Logout</a>
                </li>

            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="src/Views/Users/login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="src/Views/Users/register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
