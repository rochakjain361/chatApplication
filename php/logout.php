<?php
session_start();
if(isset($_SESSION['username'])){
unset($_SESSION['username']);
unset($_SESSION['to_user']);
header("Location: login.php");
}
else
{
    header("Location: ../php/login_new_file.php");
}

?>
