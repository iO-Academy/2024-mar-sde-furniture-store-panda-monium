<?php
require_once 'src/Models/CategoryModel.php';
require_once 'src/Services/ProductsDisplayService.php';
require_once 'src/Models/ProductModel.php';
require_once 'src/Factory/furnitureDatabaseConnector.php';
require_once 'src/Entities/ProductsEntity.php';

$db = furnitureDatabaseConnector::connect();
$id = $_GET["id"];

$products = "";
$error = false;



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Furniture Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<nav class="bg-slate-800 py-2 px-5">
    <span class="text-4xl text-white">Furniture Store</span>
</nav>
<header class="container mx-auto md:w-2/3 md:mt-10 py-16 px-8 bg-slate-200 rounded">
    <?php

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $products = ProductModel::getProducts($db, $id);

        if ($products === []) {
            echo '<h1 class="text-5xl mb-2"> Oops, something went wrong </h1>
        <a href="index.php" class="inline-block bg-blue-600 px-3 py-2 rounded text-white">Home</a>';
            return ;
        } else {
            $category = CategoryModel::getCategoryTitle($db, $id);
        }
    } else {
        echo '<h1 class="text-5xl mb-2"> Oops, something went wrong </h1>
        <a href="index.php" class="inline-block bg-blue-600 px-3 py-2 rounded text-white">Home</a>';
        return ;
    }

    ?>
    <h1 class="text-5xl mb-2">Category: <?php echo $category->getName() ?> </h1>
    <p>For more information about any of the below products, click on the more button.</p>
</header>
<div class="container mx-auto md:w-2/3 mt-5">
    <a href="index.php" class="text-blue-500">Back</a>
</div>
<section class="container mx-auto md:w-2/3 grid md:grid-cols-4 gap-5 mt-5">
    <?php
            foreach ($products as $product) {
                echo ProductsDisplayService::displayProducts($product);
            }
    ?>
</section>
<footer class="container mx-auto md:w-2/3 border-t mt-10 pt-5">
    <p>© Copyright iO Academy 2022</p>
</footer>
</body>
</html>
