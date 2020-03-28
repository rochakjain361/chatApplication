<?php
session_start();
include '../php/connect.php';
if(isset($_SESSION['username'])){
    if(isset($_SESSION['to_user'])){
        unset($_SESSION['to_user']);
    }
$username = $_SESSION['username'];
$query = "SELECT * FROM rochak_users WHERE username = '$username' ;";
$r = $connection->query($query);
$row = mysqli_fetch_assoc($r); 
$query2 = "SELECT * FROM rochak_profiles WHERE uname = '$username' ;";
$r2 = $connection->query($query2);
$row2 = mysqli_fetch_assoc($r2);
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Chats Page</title>
    <style>
        body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 300px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color:#212121 ;
  overflow-x: hidden;
  padding-top: 20px;
  color: #f1f1f1;
}

.sidenav a {
  padding-right:32px;
  padding-left:0px;
  padding-top:6px;
  padding-bottom:6px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}
.sidenavContents {
 padding-left:20px;
}

.main {
  margin-left: 315px;
  margin-right: 15px;
  margin-top: 50px;
  background-color: #fbfbf8;
   /* Same as the width of the sidenav */
}
#show{
  background-color:#f1f1f1;
  text-color: #f1f1f1;
  font-size: 20px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
    </style>
</head>
<body>
<div class="sidenav">
    <div class="sidenavContents"><img height="150" width="150" src="<?php echo $row2['image']; ?>" style = "margin-left: 25; margin-top:25px">
    <h2> Name: <?php echo $row2['fname']." ".$row2['sname']; ?> </h2>
    <br> Greetings 
    <br> Email: <?php echo $row['email']; ?>
    <br> Username: <?php echo $_SESSION['username']; ?>
    <br> Gender: <?php echo $row['gender']; ?>
    <br><br><br><br>
    <a href = "">EDIT PROFILE</a>
    <a href = "">LOGOUT</a>
</div>
</div>
<div class="main">
<center>Users available for chat</center>
  <form action="../php/chatmessages.php" method = "POST">
  <?php
  $query3 = "SELECT username FROM rochak_users WHERE NOT username = '$username';";
  $r3 = $connection->query($query3);
  while($row3=mysqli_fetch_assoc($r3))
  {
    ?>
    <input type = "radio" name = "to_user" id="<?php echo $row3['username']; ?>" value="<?php echo $row3['username']; ?>">
    <label for = "<?php echo $row3['username']; ?>"> <?php echo $row3['username']; ?></label>
    <br>
    <br>
    <br>
    <?php
  }
}
else 
{
  header("Location: ../php/login_new_file.php");
}
?>
<center>
<input type="submit" value="Messages" name="show" id="show">
</center><br>
</form>
</div>
</body>
