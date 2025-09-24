<?php

require_once "vendor/autoload.php";

use webshop\Controllers\ImageController;
use webshop\Controllers\UserController;
use webshop\Controllers\ProductController;
use webshop\Models\Product;

$action = $_REQUEST['action'] ?? 'home';

switch ($action) {

    case 'login':
        (new UserController())->login($_POST);
        break;

    case 'register':
        (new UserController())->register($_POST);
        break;

    case 'newProduct':
        (new ProductController())->addNewProduct($_POST);
        $productId = (new Product())->getIdByName($_POST['name']);
        (new ImageController())->uploadProductImages($_FILES["images"], $productId);
        break;

    default:
        include __DIR__ . '/src/views/home.php';
        break;
}