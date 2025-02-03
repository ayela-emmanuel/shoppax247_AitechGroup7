<?php
include_once __DIR__."/db/products_util.php";

$products = get_products();

?>
<?php include __DIR__."/includes/header.php"?>
<body>


<?php include __DIR__."/includes/nav.php"?>



<div class="container">
<button  class="btn btn-primary" onclick="showCart()">Show Cart</button>
<div id="cart">

</div>

</div>

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
        <button  class="btn btn-primary" onclick="addToCart(<?php echo $product['id']?>)">Add To Cart</button>
    </div>
</div>
<?php }  ?>
<?php ?>
</div>






<?php include __DIR__."/includes/footer.php"?>


<script src="/assets/js/main.js"></script>
</body>
</html>