<?php include "src/Views/layouts/header.php"; ?>

<div class="container my-5">
    <h2>Vaša korpa</h2>

    <?php if (!empty($cart)): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Naziv</th>
                <th>Cena</th>
                <th>Količina</th>
                <th>Ukupno</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0; ?>
            <?php foreach ($cart as $item): ?>
                <?php $subtotal = $item['price'] * $item['quantity']; ?>
                <?php $total += $subtotal; ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?> RSD</td>
                    <td><?= (int)$item['quantity'] ?></td>
                    <td><?= number_format($subtotal, 2) ?> RSD</td>
                    <td>
                        <a href="index.php?action=removeFromCart&id=<?= $item['id'] ?>"
                           class="btn btn-danger btn-sm">
                            Ukloni
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <th colspan="3" class="text-end">Ukupno:</th>
                <th><?= number_format($total, 2) ?> RSD</th>
                <th></th>
            </tr>
            </tbody>
        </table>

        <div class="text-end">
            <a href="index.php?action=confirmOrder" class="btn btn-success btn-lg">
                Potvrdi porudžbinu
            </a>
        </div>

    <?php else: ?>
        <div class="alert alert-info">
            Vaša korpa je prazna.
        </div>
    <?php endif; ?>
</div>

<?php include "src/Views/layouts/footer.php"; ?>
