<?php
include __DIR__ . '/../layouts/adminHeader.php';
?>

<h2>Dodajte novi proizvod</h2>
<form method="post" action="index.php?action=saveProduct" class="row g-3" enctype="multipart/form-data">

    <div class="col-md-6">
        <label class="form-label">Kategorija</label>
        <select name="category" class="form-select" required>
            <option value="" disabled selected>-- Izaberite kategoriju --</option>
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
        <input type="number" step="0.01" class="form-control" name="price" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Na stanju</label>
        <input type="number" class="form-control" name="stock" required>
    </div>


    <div class="col-md-6">
        <label class="form-label">Slike proizvoda</label>
        <input type="file" class="form-control" name="images[]" multiple>
    </div>

    <div class="col-12">
        <label class="form-label">Opis</label>
        <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Dodaj proizvod</button>
    </div>

</form>

<?php
include __DIR__ . '/../layouts/adminFooter.php';
?>
