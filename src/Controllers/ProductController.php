<?php

namespace webshop\Controllers;
use webshop\Models\Product;
use webshop\Services\InputService;
use webshop\Services\SessionService;

class ProductController extends SessionService {

    public function addNewProduct($data) {

        $inputService = new InputService();
        $requiredFields = ['category', 'name', 'description', 'price', 'brand', 'stock'];
        $errors = $inputService::validateRequired($data, $requiredFields);

        if (count($errors) > 0) {
            $this->setSession('errors', $errors);
            header("Location: src/views/admin/dashboard.php?page=add-product");
            exit;
        }

        $categoryId = $data['category'];
        $name = $data['name'];
        $description = $data['description'];
        $price = $data['price'];
        $brand = $data['brand'];
        $stock = $data['stock'];

        $productModel = new Product();
        $productModel->createProduct($categoryId, $name, $description, $brand, $price, $stock);
    }


}