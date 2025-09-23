<?php

namespace webshop\Models;

class Db{

    public $connection;

    public function __construct()
    {
        $this->connection = new \PDO('mysql:host=localhost;dbname=webshop', 'root', '');
    }
}