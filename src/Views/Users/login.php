<?php include __DIR__.'/../layouts/header.php'; ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 1rem;">
        <div class="text-center mb-4">
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3" style="width:60px; height:60px; font-size:28px;">
                <i class="bi bi-person"></i>
            </div>
            <h3 class="fw-bold">Login</h3>
            <p class="text-muted">Prijavite se na svoj nalog</p>
        </div>
        <form action="index.php" method="POST">

            <input type="hidden" name="action" value="login">

            <div class="mb-3">
                <label for="username" class="form-label">Korisničko ime</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Unesite korisničko ime" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Lozinka</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Unesite lozinku" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Prijavi se</button>
        </form>
        <div class="text-center mt-3">
            <small class="text-muted">Nemate nalog? <a href="register.php">Registrujte se</a></small>
        </div>
    </div>
</div>

<?php include __DIR__ . '/app/views/layouts/footer.php'; ?>
