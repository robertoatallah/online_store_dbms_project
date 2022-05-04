<?php
    session_start();
    include("connection.php");
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $pass = $_POST["pass"];
    $pass = md5($pass);
    $dob = $_POST["dob"];
    $phone = $_POST["phone"];
    $date_joined = date('m/d/Y h:i:s a', time());
    $user_type_id = 2;
    $sql = "select * from users where email = '$email'";  
    $result = mysqli_query($con, $sql);  
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
    $error = "This following email is already registered. Log in to your account or Sign up using a different email.";
    if($count == 1){  
        $_SESSION["error"] = $error;
        header("Location: signup.php");
    }else{  
        $_SESSION["email"] = $email;
        $query = $mysqli->prepare("INSERT INTO users (first_name, last_name, gender, email, password, phone, date_of_birth, date_joined, user_type_id) VALUES(?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssssssss", $first_name, $last_name, $gender, $email, $pass,  $phone, $dob, $date_joined, $user_type_id); 
        $query->execute();
        $sql = "select * from users where email = '$email' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION["user_id"] = $row['id'];
        $_SESSION["user_name"] = $row['first_name'] . " " . $row['last_name'];
        $query->close();
        $query = $mysqli->prepare("INSERT INTO carts ( user_id ) VALUES(?)");
        $query->bind_param("i", $_SESSION["user_id"]); 
        $query->execute();
        $query->close();
        $sql = " select * from carts order by id desc limit 1; ";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $_SESSION["cart_id"] = $row['id'];
        header("Location: index.php");
        exit();
    }

?>