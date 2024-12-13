<?php
session_start();
$data = file_get_contents("php://input");

$data = json_decode($data, true);

$tasks = $_SESSION["tasks"] ?? [];

if(isset($data["task"])){
    
    
    $tasks[] = $data["task"];

    $_SESSION["tasks"] = $tasks;
}
