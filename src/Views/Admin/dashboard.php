<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /webshop/src/Views/home.php");
    exit;
}

include __DIR__ . '/../layouts/adminHeader.php';
?>

    <h2>Admin kontrolna tabla</h2>
    <p>Dobrodošli u administratorski deo aplikacije.</p>


<?php include __DIR__ . '/../layouts/adminFooter.php'; ?>