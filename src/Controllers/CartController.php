<?php

namespace webshop\Controllers;

use webshop\Models\Order;
use webshop\Models\Product;
class CartController{

    public function add($productId){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {

            $productModel = new Product();
            $product = $productModel->getProductById($productId);

            if ($product) {
                $_SESSION['cart'][$productId] = [
                    'id'       => $product['id'],
                    'name'     => $product['name'],
                    'price'    => $product['price'],
                    'quantity' => 1,
                ];
            }
        }

        header("Location: index.php?action=cart");
        exit;
    }

        public function show()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $cart = $_SESSION['cart'] ?? [];
            include "src/Views/Cart/cart.php";
        }

    public function remove(int $productId)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        header("Location: index.php?action=cart");
        exit;
    }

}