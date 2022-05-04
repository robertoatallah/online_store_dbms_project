<?php
session_start();
include("connection.php");
$email = $_POST["email"];
$password = $_POST["password"];
$error = "Login failed. Invalid username or password.";
 //to prevent mysqli injection
$password = md5($password);
$email = stripcslashes($email);  
$password = stripcslashes($password);  
$email = mysqli_real_escape_string($con, $email);  
$password = mysqli_real_escape_string($con, $password);  

$sql = "select * from users where email = '$email' and password = '$password'";  
$result = mysqli_query($con, $sql);  
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
$count = mysqli_num_rows($result);  
  
if($count == 1){  
    $_SESSION["user_id"] = $row['id'];
    $_SESSION["user_name"] = $row['first_name'] . " " . $row['last_name'];
    $query = $mysqli->prepare("INSERT INTO carts ( user_id ) VALUES(?)");
    $query->bind_param("i", $_SESSION["user_id"]); 
    $query->execute();
    $query->close();
    $sql = " select * from carts order by id desc limit 1; ";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION["cart_id"] = $row['id'];
    header("Location: index.php");
}else{  
    $_SESSION["error"] = $error;
    header("Location: login.php");
}     

?>