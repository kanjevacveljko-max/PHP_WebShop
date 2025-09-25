<?php
include __DIR__ . '/header.php';
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
                                <li><a href="index.php?action=allProducts" class="nav-link">Svi proizvodi</a></li>
                                <li><a href="index.php?action=addProduct" class="nav-link">Novi proizvod</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
