<?php
session_start();
include_once __DIR__."/../db/products_util.php";

$id = $_GET["id"]?? null;

if($id){

header("content-type: application/json");
    $user_id = $_SESSION["user"]["id"];
    add_product_to_cart($id, $user_id);
}