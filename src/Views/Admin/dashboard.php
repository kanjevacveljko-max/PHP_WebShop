<?php
session_start();

// zaštita da samo admin može da pristupi
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /webshop/src/Views/home.php");
    exit;
}

require_once __DIR__ . '/../../../vendor/autoload.php';

use webshop\Models\Category;
use webshop\Models\Product;



include __DIR__ . '/../layouts/header.php';
?>

<div class="container-fluid">
    <div class="row">

        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse border-end">
            <div class="position-sticky pt-3">

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false">
                            <i class="bi bi-box-seam"></i> Proizvodi
                        </a>
                        <div class="collapse" id="productsMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal small ms-3">
                                <li><a href="?page=products" class="nav-link">Svi proizvodi</a></li>
                                <li><a href="src/Views/Admin/dashboard.php?page=add-product" class="nav-link">Novi proizvod</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#categoriesMenu" role="button" aria-expanded="false">
                            <i class="bi bi-folder"></i> Kategorije
                        </a>
                        <div class="collapse" id="categoriesMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal small ms-3">
                                <li><a href="?page=categories" class="nav-link">Sve kategorije</a></li>
                                <li><a href="?page=add-category" class="nav-link">Nova kategorija</a></li>
                            </ul>
                        </div>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false">
                            <i class="bi bi-people"></i> Korisnici
                        </a>
                        <div class="collapse" id="usersMenu">
                            <ul class="btn-toggle-nav list-unstyled fw-normal small ms-3">
                                <li><a href="?page=users" class="nav-link">Svi korisnici</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>


        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <?php
            $page = $_GET['page'] ?? 'products';

            if ($page === 'products'):?>

            <?php
                $categoryModel = new Category();
                $productModel = new Product();
                $products = $productModel->getAllProducts();
            ?>
                <h2>Svi proizvodi</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Naziv</th>
                        <th>Kategorija</th>
                        <th>Opis</th>
                        <th>Brend</th>
                        <th>Cena</th>
                        <th>Na stanju</th>
                        <th>Opcije </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td> <?= $product["id"] ?> </td>
                        <td> <?= $product["name"] ?> </td>
                        <td> <?= $categoryModel->getCategoryNameById($product['category_id']) ?> </td>
                        <td> <?= $product["description"] ?> </td>
                        <td> <?= $product["brand"] ?> </td>
                        <td> <?= $product["price"] ?> </td>
                        <td> <?= $product["stock"] ?> </td>
                        <td class="d-flex gap-2">
                            <a href="edit_product.php?id=1" class="btn btn-sm btn-primary w-100">Edit</a>
                            <a href="delete_product.php?id=1" class="btn btn-sm btn-danger w-100">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            <?php elseif ($page === 'add-product'): ?>
                <h2>Novi proizvod</h2>
                <form method="post" action="index.php" class="row g-3" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="newProduct">

                    <div class="col-md-6">
                        <label class="form-label">Kategorija</label>
                        <select name="category" class="form-select">
                            <option value="1">Laptopovi</option>
                            <option value="2">Monitori</option>
                            <option value="3">Računarska oprema</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Naziv</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Brend</label>
                        <input type="text" class="form-control" name="brand" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Cena</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>



                    <div class="col-md-6">
                        <label class="form-label">Na stanju</label>
                        <input type="number" class="form-control" name="stock">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slika</label>
                        <input type="file" class="form-control" name="image" >
                    </div>

                    <div class="col-12">
                        <label class="form-label">Opis</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Dodaj proizvod</button>
                    </div>

                </form>

            <?php elseif ($page === 'categories'): ?>
                <h2>Sve kategorije</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Naziv</th>
                        <th>Opis</th>
                        <th>Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Laptopovi</td>
                        <td>Kategorija za sve laptop uređaje</td>
                        <td>
                            <a href="edit_category.php?id=1" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_category.php?id=1" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Monitori</td>
                        <td>Kategorija za monitore</td>
                        <td>
                            <a href="edit_category.php?id=2" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_category.php?id=2" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            <?php elseif ($page === 'add-category'): ?>
                <h2>Nova kategorija</h2>
                <form method="post" action="add_category.php" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Naziv kategorije</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Opis</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Dodaj kategoriju</button>
                    </div>
                </form>

            <?php elseif ($page === 'users'): ?>
                <h2>Svi korisnici</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Korisničko ime</th>
                        <th>Email</th>
                        <th>Uloga</th>
                        <th>Akcije</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>veljko</td>
                        <td>veljko@example.com</td>
                        <td>admin</td>
                        <td>
                            <a href="orders.php?user_id=1" class="btn btn-sm btn-info">Porudžbine</a>
                            <a href="make_admin.php?user_id=1" class="btn btn-sm btn-success">Dodaj admina</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>marko</td>
                        <td>marko@example.com</td>
                        <td>customer</td>
                        <td>
                            <a href="orders.php?user_id=2" class="btn btn-sm btn-info">Porudžbine</a>
                            <a href="make_admin.php?user_id=2" class="btn btn-sm btn-success">Dodaj admina</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>

        </main>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
