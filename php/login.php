<?php
session_start();
include '../php/connect.php';
if(isset($_POST['username']) && isset($_POST['password'])){

$name = $_POST['username'];
$pass = $_POST['password'];

$name=htmlspecialchars($name);
$name=mysqli_real_escape_string($connection,$name);
$pass=htmlspecialchars($pass);
$pass=mysqli_real_escape_string($connection,$pass);

$query = " SELECT * FROM rochak_users WHERE username = '$name'";
$result = $connection->query($query);

$num = mysqli_num_rows($result);
if($num == 1){
	$row = mysqli_fetch_assoc($result);
	if(password_verify($pass, $row['password']))
	{
    header('Location: ../php/profileNew.php');
    $_SESSION['username']=$name;
    if(!empty($_POST['remember'])){
        setcookie('username',$name,time()+ (24*60*60));
        setcookie('password',$pass,time()+ (24*60*60));
     }
    else{
        if(isset($_COOKIE['username'])){
            setcookie('username',''); 
        }
        if(isset($_COOKIE['password'])){
            setcookie('password','');
       	}   
    }
	}
}
else{
    header('Location: ../php/login_new_file.php');
    die("Login Failed");
}
}
 ?>
