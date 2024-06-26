<?php

class ProductModel
{
    public static function getProductsByCategoryId(PDO $db, int $category_id): array
    {
        $sql = 'SELECT `price`, `color`, `stock`, `id` FROM `products` WHERE `category_id` = :category_id;';
        $query = $db->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, ProductEntity::class);
        $query->execute(['category_id' => $category_id]);
        return $query->fetchAll();
    }

    public static function getIndividualProduct(PDO $db, int $product_id): IndividualProductEntity | false
    {
        $sql = 'SELECT `price`, `color`, `stock`, `width`, `height`, `depth`, `related`, `id`, `category_id` FROM `products` WHERE `id` = :product_id;';
        $query = $db->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, IndividualProductEntity::class);
        $query->execute(['product_id' => $product_id]);
        return $query->fetch();
    }

    public static function getSimilarProduct(PDO $db, int $related_id): ProductEntity | false
    {
        $sql = 'SELECT `price`, `color`, `stock`, `id` FROM `products` WHERE `id` = :related_id;';
        $query = $db->prepare($sql);
        $query->setFetchMode(PDO::FETCH_CLASS, ProductEntity::class);
        $query->execute(['related_id' => $related_id]);
        return $query->fetch();
    }
}