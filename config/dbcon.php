<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "ecommerce";

$con = mysqli_connect($host, $username, $password, $database);

if(!$con){
    header("Location: ../errors/db.php");
}else{
    // echo"Database Connected!";
}
?>