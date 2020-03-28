<?php
session_start();
include '../php/connect.php';
if(isset($_POST['username']) && isset($_POST['password'])){

$name = $_POST['username'];
$pass = $_POST['password'];

$query = " SELECT * FROM rochak_users WHERE username = '$name' AND password = '$pass' ";
$result = $connection->query($query);

$num = mysqli_num_rows($result);
if($num == 1){
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
else{
    header('Location: ../php/login_new_file.php');
    die("Login Failed");
}
}
 ?>
