<?php

namespace webshop\Models;

class Product extends Db {

    public function getAllProducts()
    {
        $stmt = $this->connection->prepare("SELECT * FROM `products`");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function productExists($name)
    {
        $stmt = $this->connection->prepare("SELECT * FROM `products` WHERE `name` = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        
        return $stmt->rowCount() > 0 ? true : false;
    }

    public function createProduct(int $categoryId, string $name, string $description, string $brand, int $price, int $stock, string $image)
    {
        $stmt = $this->connection->prepare("insert into `products` (category_id, name, description, brand, price, stock, image)
                                                  values (:category_id, :name, :description, :brand, :price, :stock, :image)");
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':image', $image);

        $stmt->execute();

    }
}