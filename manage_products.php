<?php
session_start();
include_once __DIR__."/db/products_util.php";
if(!isset($_SESSION["user"])){
    header("Location: /auth.php");
}
$products = get_products();

?>

<ul>
    <?php foreach ($products as $product) {
    ?>
    <li>
        <?= htmlspecialchars($product["name"]) ?>
    </li>
    <?php }?>
</ul>