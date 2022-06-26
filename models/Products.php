<?php

class Products extends DB {

    /**
     * This function return array of products from db
     * @return array
     */
    public static function get_all_products():array {
        $sql = "SELECT * FROM `products` WHERE 1";

        $pdo = new DB();
        $st = $pdo->connect()->query($sql);

        $results = $st->fetchAll();

        return $results;
    }

}