<?php
include '../php/connect.php'
$user = $_GET['user'];
$email = $_GET['email'];
if($user != ""){
    $query6 = "SELECT * FROM rochak_users WHERE username = '$user';";
    $res = $connection_>($query6);
    $count = mysqli_num_rows($res);
    if($count >=1 ){
	    header("Location: ../html/register.html");
	    die("Username already exists");
    }
}
if($email != ""){
    $query7 = "SELECT * FROM rochak_users WHERE email = '$email';";
    $res2 = $connection_>($query7);
    $count2 = mysqli_num_rows($res2);
    if($count2 >=1 ){
	    header("Location: ../html/register.html");
	    die("Email already in use");
    }
}
?>
