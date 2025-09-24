<?php

namespace webshop\Models;
class Image extends Db {

    public function uploadIntoDatabase(string $productId, string $imageUrl): void
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO images (product_id, image_path) 
                   VALUES (:product_id, :image_url)");
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':image_url', $imageUrl);
        $stmt->execute();
    }
}