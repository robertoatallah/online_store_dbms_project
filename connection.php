<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = null;
$db_database = "thriftshopdb";

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_database);
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
?>