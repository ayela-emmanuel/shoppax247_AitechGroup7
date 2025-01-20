<?php

const  DB_Host = "localhost";
const DB_Password = "";
const DB_User = "root";
const DB_Name = "shopper";

$Connection = new mysqli(
    DB_Host,
    DB_User,
    DB_Password,
    DB_Name
);

if($Connection->errno){
    die("Error Connecting To Database");
}


