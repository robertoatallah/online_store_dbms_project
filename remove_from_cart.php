<?php
session_start();
include("connection.php");  
$carts_id = $_POST['id'];
$products_id =  $_POST['products_id'];
$query = $mysqli->prepare("DELETE FROM carts_contains_products WHERE carts_id = '$carts_id' AND products_id = '$products_id'");
$query->execute();
$query->close();
header("Location: cart.php");   
?>