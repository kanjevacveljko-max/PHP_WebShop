<?php

namespace webshop\Models;

use PDO;

class Product extends Db {

    public function getAllProducts()
    {
        $stmt = $this->connection->prepare("SELECT * FROM products");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(":id", $productId);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function productExists(int $id): bool
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->rowCount() > 0;
    }

    public function productExistsName(string $name): bool
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }


    public function deleteProduct(int $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


    public function createProduct(int $categoryId, string $name, string $description, string $brand, int $price, int $stock): int
    {
        $stmt = $this->connection->prepare("insert into `products` (category_id, name, description, brand, price, stock)
                                                  values (:category_id, :name, :description, :brand, :price, :stock)");
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock', $stock);

        $stmt->execute();

        return $this->connection->lastInsertId();
    }

    public function updateProduct(array $data): void
    {
        $stmt = $this->connection->prepare("update products 
                                    set category_id = :category_id,
                                    name = :name, 
                                    description = :description,
                                    brand = :brand,
                                    price = :price,
                                    stock = :stock
                                    where id = :id");
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':brand', $data['brand']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':stock', $data['stock']);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();
    }
}