<?php include "src/Views/layouts/header.php"; ?>

    <div class="container my-5">
        <div class="row g-4">
            <?php foreach ($products as $product):?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">

                        <div class="card-header text-center fw-bold">
                            <?= htmlspecialchars($product['name']) ?>
                        </div>

                        <?php if ($imageModel->existsImageForProduct($product['id'])): ?>
                            <img src="<?= htmlspecialchars($imageModel->getImageUrl($product['id'])) ?>"
                                 class="card-img-top img-fluid"
                                 alt="<?= htmlspecialchars($product['name']) ?>"
                                 style="object-fit: cover; height: 250px;">
                        <?php else: ?>
                            <img src="public/no-image.png"
                                 class="card-img-top img-fluid"
                                 alt="No image"
                                 style="object-fit: cover; height: 200px;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column justify-content-between">
                            <p class="card-text text-center fs-5 fw-semibold text-success mb-3">
                                <?= number_format($product['price'], 2) ?> RSD
                            </p>
                            <a href="index.php?action=productPage&id=<?= $product['id'] ?>"
                               class="btn btn-primary w-100">
                                POGLEDAJ PROIZVOD
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php include "src/Views/layouts/footer.php"; ?>