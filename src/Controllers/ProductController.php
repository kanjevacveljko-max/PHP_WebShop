<?php

namespace webshop\Controllers;
use webshop\Models\Category;
use webshop\Models\Image;
use webshop\Models\Product;
use webshop\Services\InputService;
use webshop\Services\SessionService;

class ProductController {

    public function showAllProducts()
    {
        $imageModel = new Image();
        $productModel = new Product();
        $products = $productModel->getAllProducts();
        include __DIR__ . '/../views/products/allProducts.php';
    }

    public function showProduct($productId)
    {
        $imageModel = new Image();
        $productModel = new Product();
        $categoryModel = new Category();
        $product = $productModel->getProductById($productId);
        $image = $imageModel->getImageUrl($productId);
        $stock = $product['stock'] > 0 ? "Ima na stanju!" : "Nema na stanju!";
        $category = $categoryModel->getCategoryNameById($product['category_id']);

        include __DIR__ . '/../views/products/productPage.php';
    }

}