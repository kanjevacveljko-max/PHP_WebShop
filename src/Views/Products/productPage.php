
<?php

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    include "src/Views/layouts/header.php";
?>

    <div class="container my-5">
        <?php if ($product): ?>
            <div class="row">
                <div class="col-md-6 offset-md-3">

                    <div class="mb-4 text-center">
                        <img src="<?= htmlspecialchars($image) ?>"
                             alt="<?= htmlspecialchars($product['name']) ?>"
                             class="img-fluid rounded shadow"
                             style="max-height: 400px; object-fit: contain;">
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th>Naziv</th>
                            <td><?= htmlspecialchars($product['name']) ?></td>
                        </tr>
                        <tr>
                            <th>Opis</th>
                            <td><?= htmlspecialchars($product['description']) ?></td>
                        </tr>
                        <tr>
                            <th>Brend</th>
                            <td><?= htmlspecialchars($product['brand']) ?></td>
                        </tr>
                        <tr>
                            <th>Cena</th>
                            <td><?= number_format($product['price'], 2) ?> RSD</td>
                        </tr>
                        <tr>
                            <th>Na stanju</th>
                            <td><?= $stock ?></td>
                        </tr>
                        <tr>
                            <th>Kategorija</th>
                            <td><?= htmlspecialchars($category) ?></td>
                        </tr>
                    </table>

                    <div class="text-center">

                        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>

                            <a href="index.php?action=addToCart&id=<?= $product['id'] ?>" class="btn btn-success btn-lg">
                                Dodaj u korpu
                            </a>

                        <?php else: ?>

                            <a href="?action=loginForm&id=<?= $product['id'] ?>" class="btn btn-primary btn-lg">
                                Ulogujte se da biste nastavili
                            </a>

                            <?php $_SESSION['zapocetaKupovina'] = true;
                                  $_SESSION['productId'] = $product['id'];
                            ?>

                        <?php endif; ?>
                    </div>

                </div>
            </div>

        <?php else: ?>

            <div class="alert alert-danger text-center">
                Ovaj proizvod ne postoji.
            </div>

        <?php endif; ?>

    </div>

<?php include "src/Views/layouts/footer.php"; ?>