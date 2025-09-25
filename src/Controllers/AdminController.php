<?php

namespace webshop\Controllers;

require_once "vendor/autoload.php";

use webshop\Models\Category;
use webshop\Models\Product;
use webshop\Services\InputService;
use webshop\Services\SessionService;

class AdminController extends SessionService {

    public function addNewProduct($data) {

        $inputService = new InputService();
        $requiredFields = ['category', 'name', 'description', 'price', 'brand', 'stock'];
        $errors = $inputService::validateRequired($data, $requiredFields);

        if (count($errors) > 0) {
            $this->setSession('errors', $errors);
            header("Location: src/views/admin/dashboard.php?page=add-product");
            exit;
        }

        $productModel = new Product();
        if($productModel->productExistsName($data["name"]))
        {
            $this->setSession('errors', 'Ovaj proizvod vec postoji');
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

        return $productModel->createProduct($categoryId, $name, $description, $brand, $price, $stock);
    }

    public function deleteProduct(int $productId)
    {
        $productModel = new Product();

        if(!$productModel->productExists($productId))
        {
            $this->setSession('errors', 'Ovaj proizvod ne postoji u bazi.');
            header("Location:index.php?action=allProducts");
            exit;
        }

        $productModel->deleteProduct($productId);

        header("Location:index.php?action=allProducts");
    }

    public function showAllProducts()
    {
        $productModel = new Product();
        $categoryModel = new Category();

        $products = $productModel->getAllProducts();

        include __DIR__ . "/../Views/Admin/allProducts.php";

    }

    public function editProduct(int $productId){

        $productModel = new Product();

        if($productModel->productExists($productId)){
            $product = $productModel->getProductById($productId);
            include __DIR__ . "/../Views/Admin/editProduct.php";
        }

    }

    public function updateProduct(array $data)
    {
        $inputService = new InputService();
        $requiredFields = ['category_id', 'name', 'description', 'price', 'brand', 'stock'];
        $errors = $inputService::validateRequired($data, $requiredFields);

        if (count($errors) > 0) {
            $this->setSession('errors', $errors);
            header("Location: src/views/admin/dashboard.php?page=add-product");
            exit;
        }
        $productModel = new Product();

        $productModel->updateProduct($data);

        header("Location:index.php?action=allProducts");
    }


}