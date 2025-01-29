<?php

session_start();
include_once __DIR__."/db/products_util.php";
if(!isset($_SESSION["user"])){
    header("Location: /auth.php");
}

try{
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        HandleProductCreation();
    }
    if(isset($_GET['delete'])){
        HandleProductDelete();
    }
}catch(Exception $e){
    $message = $e->getMessage();
    echo "<div class='error-message'>$message</div>";
}


$products = get_products();




include __DIR__."/includes/header.php"

?>

<body>
<?php include __DIR__."/includes/nav.php"?>
<link rel="stylesheet" href="/assets/css/admin.css">

<div class="container">
    <button class="btn create_btn btn-primary">Create Product</button>
</div>
<div id="product-form-container">


<form action="" method="post" enctype="multipart/form-data">
    <h1>Create A New Product</h1>
    <div>
        <label for="name">Product Name</label>
        <input type="text" name="name">
    </div>

    <div>
        <label for="price">Product Price</label>
        <input type="number" name="price">
    </div>

    <div>
        <label for="name">Product Image</label>
        <input type="file" name="image">
    </div>
    <br/>

    <button class="btn create_btn btn-danger" type="button">Close</button>

    <button  class="btn btn-success" name="action" value="create">Submit</button>
</form>
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
        <a href="?delete=<?= $product["id"]?>" class="btn btn-danger">Delete</a>
        <a href="#" class="btn btn-primary">Modify</a>
    </div>
</div>
<?php }  ?>
</div>



<script src="/assets/js/admin.js"></script>
<?php include __DIR__."/includes/footer.php"?>
</body>