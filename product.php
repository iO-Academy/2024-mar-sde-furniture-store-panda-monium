<?php
require_once 'src/Services/ProductsDisplayService.php';
require_once 'src/Models/ProductModel.php';
require_once 'src/Factory/furnitureDatabaseConnector.php';
require_once 'src/Entities/ProductEntity.php';

$db = furnitureDatabaseConnector::connect();
$error_template = '<h1 class="text-5xl mb-2"> Oops, something went wrong </h1>';
$id = $_GET['id'];
$product = ProductModel::getIndividualProduct($db, $id);
$related_id = $product->getRelated();
$similarProduct = ProductModel::getSimilarProduct($db, $related_id);

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
    <p>If this is not the right product for you, use the back button below to see our wide selection of other products.</p>
</header>
<div class="container mx-auto md:w-2/3 mt-5">
    <a href="index.php" class="text-blue-500">Back</a>
</div>
<section class="container mx-auto md:w-2/3 border p-8 mt-5">
   <?php echo ProductsDisplayService::displayIndividualProduct($product) ?>
</section>

    <?php
    if ($similarProduct) {
        echo ProductsDisplayService::displaySimilarProduct($similarProduct);
    }
    ?>

<footer class="container mx-auto md:w-2/3 border-t mt-10 pt-5">
    <p>© Copyright iO Academy 2022</p>
</footer>

</body>
</html>
