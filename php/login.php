<?php

include '../php/connect.php';

$name = $_POST['username'];
$pass = $_POST['password'];

$query = " SELECT * FROM rochak_users WHERE name = '$name' AND passoword = '$pass' ";
$result = $connection->query($query);

$num = mysqli_num_rows($result);

if($num == 1){
    header('location:');
    die("Successfully Logged In");
}
else{
    header('location:');
    die("Login Failed");
}
 ?>
