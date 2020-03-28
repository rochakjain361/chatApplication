<?php 
session_start();
include "../php/connect.php";
if(isset($_POST['send']))
{
    $to_user = $_SESSION['to_user'];
    $message = $_POST['message'];
    $from_user = $_SESSION['username'];
    $q = "INSERT INTO rochak_messages (from_user, to_user, message) VALUES ('$from_user','$to_user','$message');";
    $res = $connection->query($q);
    if($res){
        header("Location: ../php/chatmessages.php");
    }

}
else
{
    header("Location: ../php/dashboard.php");
}
?>
