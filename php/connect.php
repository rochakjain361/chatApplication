<?php
$host = "localhost";
$username = "first_year";
$password = "first_year";
$database = "first_year";

$connection = new mysqli($host, $username, $password, $database);

if (!$connection) {
   die('can not connect:' .mysql_error());
}
?>
