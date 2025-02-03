<?php
session_start();
include_once __DIR__."/../db/products_util.php";

header("content-type: application/json");
$user_id = $_SESSION["user"]["id"];
echo json_encode(get_cart($user_id));