<?php

include '../php/connect.php';

$name = $_POST['username'];
$pass = $_POST['password'];

$query = " SELECT * FROM rochak_users WHERE username = '$name' AND password = '$pass' ";
$result = $connection->query($query);

$num = mysqli_num_rows($result);
if($num == 1){
    header('Location: ../html/chats.html');
    if(!empty($_POST['remember'])){
        setcookie('username',$_POST['username'],time()+ (10*365*24*60*60));
        setcookie('passowrd',$_POST['password'],time()+ (10*365*24*60*60));
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
?> 
