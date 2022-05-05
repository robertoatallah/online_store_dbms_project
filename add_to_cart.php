<?php
session_start();
include("connection.php");  
if ($_SESSION["user_id"] == null) {
  header("Location: login.php");
  exit();
}
$id = $_POST['id'];
$cart_id =  $_SESSION["cart_id"];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$query = $mysqli->prepare("INSERT INTO carts_contains_products ( carts_id, products_id, size, quantity ) VALUES(?,?,?, ?)");
$query->bind_param("iisi", $cart_id, $id, $size, $quantity); 
$query->execute();
$query->close();
header("Location: cart.php");
?>