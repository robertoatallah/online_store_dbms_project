<?php
session_start();
include("connection.php");
$user_id = $_SESSION["user_id"];
$sum_total = $_SESSION["sum_total"];
$cart_id = $_SESSION["cart_id"];
$payment_type = "cash";
$address = $_POST["firstName"]." ".$_POST["lastName"]." ".$_POST["phone"]." ".$_POST["company"]." ".$_POST["country"]." ".$_POST["address"]." ".$_POST["addressalt"]." ".$_POST["city"]." ".$_POST["state"]." ";
$query = $mysqli->prepare("UPDATE users SET address = '$address' WHERE  id = '$user_id'");
$query->execute();
$query = $mysqli->prepare("INSERT INTO payments ( payment_type, amount, carts_id ) VALUES(?, ? , ?)");
$query->bind_param("ssi", $payment_type, $sum_total, $cart_id); 
$query->execute();

$sql = " select * from payments order by id desc limit 1; ";  
$result = mysqli_query($con, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$payment_id = $row["id"];
$com = "DHL";
$time = "2 to 5 business days";
$query = $mysqli->prepare("INSERT INTO shipments ( shipment_company, estimated_shipment_time,  payments_id ) VALUES(?,?,?)");
$query->bind_param("ssi", $com, $time, $payment_id); 
$query->execute();

$query = $mysqli->prepare("DELETE FROM carts_contains_products WHERE carts_id= '$cart_id'");
$query->execute();
header("Location: index.php")
?>