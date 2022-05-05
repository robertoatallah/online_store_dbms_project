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
$query = $mysqli->prepare("INSERT INTO carts_contains_products ( carts_id, products_id, size ) VALUES(?,?,?)");
$query->bind_param("iii", $cart_id, $id, $size); 
$query->execute();
$query->close();
header("Location: cart.php");
?>