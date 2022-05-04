<?php
session_start();
include("connection.php");  
$id = $_POST['id'];
$cart_id =  $_SESSION["cart_id"];
$quantity = 1;
$query = $mysqli->prepare("INSERT INTO carts_contains_products ( carts_id, products_id, quantity ) VALUES(?,?,?)");
$query->bind_param("iii", $cart_id, $id, $quantity); 
$query->execute();
$query->close();
header("Location: cart.php");
?>