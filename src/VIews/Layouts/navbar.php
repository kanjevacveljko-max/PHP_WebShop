<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand fw-bold" href="/public/index.php">💻 WebShop</a>

        <form class="d-none d-lg-flex position-absolute top-50 start-50 translate-middle"
              role="search" action="/public/search.php" method="get" style="width: 300px; transform: translate(-50%, -50%);">
            <input class="form-control me-2" type="search" name="q" placeholder="Search products..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
        </form>

        <!-- Desna strana: linkovi -->
        <ul class="navbar-nav ms-auto d-flex gap-3">
            <li class="nav-item">
                <a class="nav-link" href="/public/products.php">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/public/cart.php">Cart 🛒</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/public/login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/public/register.php">Register</a>
            </li>
        </ul>
    </div>
</nav>
