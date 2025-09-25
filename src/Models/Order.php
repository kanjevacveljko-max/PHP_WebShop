<?php

namespace webshop\Models;

class Order extends Db{

    public function makeOrder(int $userId, array $cart){

        $this->connection->beginTransaction();


        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $stmt = $this->connection->prepare("
        INSERT INTO orders (user_id, total_price, order_date, status) 
        VALUES (:user_id, :total_price, NOW(), 'pending')
    ");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->execute();

        $orderId = $this->connection->lastInsertId();

        $stmtItem = $this->connection->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price) 
        VALUES (:order_id, :product_id, :quantity, :price)
    ");

        foreach ($cart as $item) {
            // 1. Ubaci stavku u order_items
            $stmtItem->bindParam(':order_id', $orderId);
            $stmtItem->bindParam(':product_id', $item['id']);
            $stmtItem->bindParam(':quantity', $item['quantity']);
            $stmtItem->bindParam(':price', $item['price']);
            $stmtItem->execute();


            $stmtUpdate = $this->connection->prepare("
                                             UPDATE products 
                                             SET stock = stock - :quantity 
                                             WHERE id = :product_id");
            $stmtUpdate->bindParam(':quantity', $item['quantity']);
            $stmtUpdate->bindParam(':product_id', $item['id']);
            $stmtUpdate->execute();
        }

        $this->connection->commit();

        return $orderId;
    }

}