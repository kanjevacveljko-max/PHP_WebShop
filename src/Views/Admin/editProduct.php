<?php

    include __DIR__ . '/../layouts/adminHeader.php';

?>

<h2>Izmenite proizvod</h2>
<form method="post" action="index.php" class="row g-3" enctype="multipart/form-data">

    <input type="hidden" name="action" value="updateProduct">
    <input type="hidden" name="id" value="<?= $product["id"] ?>">

    <div class="col-md-6">
        <label class="form-label">Kategorija</label>
        <select name="category_id" class="form-select">
            <option value="1" <?= $product["category_id"] == "1" ? "selected" : ""?> >Laptopovi</option>
            <option value="2" <?= $product["category_id"] == "2" ? "selected" : ""?> >Monitori</option>
            <option value="3" <?= $product["category_id"] == "3" ? "selected" : ""?> >Računarska oprema</option>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Naziv></label>
        <input type="text" value="<?= $product["name"] ?>" class="form-control" name="name" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Brend</label>
        <input type="text" value="<?= $product["brand"] ?>" class="form-control" name="brand" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cena</label>
        <input type="number" value="<?= $product["price"] ?>" class="form-control" name="price" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Na stanju</label>
        <input type="number" value="<?= $product["stock"] ?>" class="form-control" name="stock">
    </div>

    <div class="col-12">
        <label class="form-label">Opis</label>
        <textarea class="form-control" name="description" rows="3"><?= htmlspecialchars($product["description"]) ?></textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Sacuvaj</button>
    </div>

</form>