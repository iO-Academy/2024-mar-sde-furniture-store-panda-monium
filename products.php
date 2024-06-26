<?php
require_once 'src/Models/CategoryModel.php';
require_once 'src/Services/ProductsDisplayService.php';
require_once 'src/Models/ProductModel.php';
require_once 'src/Factory/FurnitureDatabaseConnector.php';
require_once 'src/Entities/ProductEntity.php';

$db = FurnitureDatabaseConnector::connect();
$products = [];
$category = false;

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET["id"];
    $category = CategoryModel::getCategoryById($db, $id);
}

if ($category) {
    $products = ProductModel::getProductsByCategoryId($db, $id);
}
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
            if ($category) {
                echo '<h1 class="text-5xl mb-2">Category: ' . $category->getName() . '</h1>
                <p>For more information about any of the below products, click on the more button.</p>';
            } else {
                echo '<h1 class="text-5xl mb-2"> Oops, something went wrong </h1>';;
            }
            ?>
        </header>
        <div class="container mx-auto md:w-2/3 mt-5">
            <a href="index.php" class="text-blue-500">Back</a>
        </div>
        <section class="container mx-auto md:w-2/3 grid md:grid-cols-4 gap-5 mt-5">
            <?php
                foreach ($products as $product) {
                    echo ProductsDisplayService::displayProduct($product);
                }
            ?>
        </section>
        <footer class="container mx-auto md:w-2/3 border-t mt-10 pt-5">
            <p>© Copyright iO Academy 2022</p>
        </footer>
    </body>
</html>
