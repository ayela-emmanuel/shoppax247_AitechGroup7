<?php
include_once __DIR__."/db/products_util.php";

$products = get_products();

?>
<?php include __DIR__."/includes/header.php"?>
<body>


<?php include __DIR__."/includes/nav.php"?>




<div class="grid">
<?php


foreach($products as $key=>$product) { 
    # code...
?>
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?php echo $product['img']?>" alt="Card image cap"/>
    <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($product['name'])?></h5>
        <p class="card-text">NGN <?= $product['price']?></p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
<?php }  ?>
<?php ?>
</div>






<?php include __DIR__."/includes/footer.php"?>


</body>
</html>