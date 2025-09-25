<?php

require_once "vendor/autoload.php";

use webshop\Controllers\AdminController;
use webshop\Controllers\CartController;
use webshop\Controllers\ImageController;
use webshop\Controllers\UserController;
use webshop\Controllers\ProductController;
use webshop\Models\Order;
use webshop\Models\Product;

$action = $_REQUEST['action'] ?? 'home';

switch ($action) {

    case'loginForm':
        include "src/views/users/login.php";

    case 'login':
        (new UserController())->login($_POST);
        break;

    case 'logout':
        (new UserController())->logout();
        break;

    case 'register':
        (new UserController())->register($_POST);
        break;

    case 'adminDashboard':
        include "src/views/admin/dashboard.php";
        break;

    case 'addProduct':
        include "src/views/admin/addProduct.php";
        break;

    case 'saveProduct':
        $productId = (new AdminController())->addNewProduct($_POST);
        (new ImageController())->uploadProductImages($_FILES["images"], $productId);
        break;

    case 'allProducts':
        (new AdminController())->showAllProducts();
        break;

    case 'deleteProduct':
        (new AdminController())->deleteProduct($_GET["id"]);
        break;

    case 'editProduct':
        (new AdminController())->editProduct($_GET["id"]);
        break;

    case 'updateProduct':
        (new AdminController())->updateProduct($_POST);
        break;

    case 'products':
        $productModel = new Product();
        (new ProductController())->ShowAllProducts();
        break;

    case 'productPage':
        $productController = new ProductController();
        $productController->showProduct($_GET["id"]);

    case 'addToCart':
        $productId = (int)$_GET['id'];
        $cartController = new CartController();
        $cartController->add($productId);
        break;

    case 'removeFromCart':
        $productId = (int)$_GET['id'];
        $cartController = new CartController();
        $cartController->remove($productId);
        break;

    case 'cart':
        $cartController = new CartController();
        $cartController->show();
        break;

    case 'confirmOrder':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $cart = $_SESSION['cart'] ?? [];
        $userId = $_SESSION['user_id'] ?? null;

        if ($userId && !empty($cart)) {
            $orderModel = new Order();
            $orderId = $orderModel->makeOrder($userId, $cart);

            unset($_SESSION['cart']);
            $_SESSION['success'][] = "Porudžbina #$orderId je uspešno napravljena!";

            header("Location: index.php?action=cart");
            exit;
        } else {
            $_SESSION['errors'][] = "Morate biti ulogovani i imati proizvode u korpi.";
            header("Location: index.php?action=cart");
            exit;
        }

    default:
        include "src/Views/home.php";
        break;
}