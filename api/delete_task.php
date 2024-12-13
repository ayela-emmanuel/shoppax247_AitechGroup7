<?php
session_start();
if(!isset($_GET["delete"])){
    exit("No index");
}
$tasks = $_SESSION["tasks"] ?? [];
$index = $_GET["delete"]?? -1; 
array_splice($tasks,$index,1);
$_SESSION["tasks"] = $tasks;
?>