<?php
session_start();
$tasks = $_SESSION["tasks"] ?? [];
header("Content-Type: Application/Json");
echo json_encode($tasks);
?>