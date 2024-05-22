<?php
require_once 'src/Services/ProductsDisplayService.php';
require_once 'src/Models/ProductModel.php';
require_once 'src/Factory/furnitureDatabaseConnector.php';
require_once 'src/Entities/ProductEntity.php';

$db = furnitureDatabaseConnector::connect();
$error_template = '<h1 class="text-5xl mb-2"> Oops, something went wrong </h1>';
$product = [];

if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET["id"];
    $product = ProductModel::getIndividualProduct($db, $id);
} else {
    $product = null;
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
    if (!is_null($product)) {
    echo '<p>If this is not the right product for you, use the back button below to see our wide selection of other products.</p>';
    } else {
    echo $error_template;
    }
    ?>
</header>


<div class="container mx-auto md:w-2/3 mt-5">
    <a href="index.php" class="text-blue-500">Back</a>
</div>

<section class="container mx-auto md:w-2/3 border p-8 mt-5">
   <?php echo ProductsDisplayService::displayIndividualProduct($product) ?>
</section>

<section class="container mx-auto md:w-2/3 border p-8 mt-10">
    <h1 class="text-3xl border-b pb-3 mb-3">Similar Product</h1>
    <div class="flex justify-between items-start">
        <p class="text-2xl">£257.63</p>
        <span class="bg-teal-500 px-2 rounded">Stock: 16</span>
    </div>
    <div class="flex justify-between items-start">
        <p>Color: Khaki</p>
        <a href="product.html" class="inline-block bg-blue-600 px-3 py-2 rounded text-white mt-1">More >></a>
    </div>
</section>

<footer class="container mx-auto md:w-2/3 border-t mt-10 pt-5">
    <p>© Copyright iO Academy 2022</p>
</footer>

</body>
</html>