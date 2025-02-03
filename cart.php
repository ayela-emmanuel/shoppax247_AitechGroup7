<?php
session_start();
include_once __DIR__."/db/products_util.php";


$user_id = $_SESSION["user"]["id"];

var_dump(get_cart($user_id));