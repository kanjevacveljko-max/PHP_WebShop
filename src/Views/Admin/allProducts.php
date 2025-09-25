<?php

include __DIR__ . '/../layouts/adminHeader.php';

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
        <?php foreach($products as $product): ?>
            <tr>
                <td> <?= $product["id"] ?> </td>
                <td> <?= $product["name"] ?> </td>
                <td> <?= $categoryModel->getCategoryNameById($product["category_id"]) ?> </td>
                <td> <?= $product["description"] ?> </td>
                <td> <?= $product["brand"] ?> </td>
                <td> <?= $product["price"] ?> </td>
                <td> <?= $product["stock"] ?> </td>
                <td class="d-flex gap-2">
                    <a href="index.php?action=editProduct&id=<?= $product["id"] ?>" class="btn btn-sm btn-primary w-100">Edit</a>
                    <a href="index.php?action=deleteProduct&id=<?= $product["id"] ?>" class="btn btn-sm btn-danger w-100">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>