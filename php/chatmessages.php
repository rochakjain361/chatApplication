<html>
    <head>
        <title> Chat Messages </title>
    </head>
    <style>
    body {
  font-family: "Lato", sans-serif;
  overflow: auto;
}

.sidenav {
  height: 100%;
  width: 300px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color:#212121;
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
.sidenavContents {
 padding-left:20px;
}
.message-box{
 height: 120px;
 margin: 10px; 
 background-color: #f1f1f1;
}
.sender{
font-size : 22px;
margin-top : 5px;
margin-left : 20px;
display: inline;
float: left;
}
.receiver{
font-size : 22px;
margin-top : 5px ;
margin-right : 20px;
display: inline;
float : right;
}
.message{
font-size : 28px;
margin-top : 50px;
margin-left : 30px;
display: inline;
float : left;
}
.time{
font-size : 18px;
margin-top : 60px;
display: inline;
margin-right : 15px;
float : right; 
}
.sidenav a:hover {
  color: #f1f1f1;
}

.main{
  margin-left: 315px;
  margin-top: 50px;
   /* Same as the width of the sidenav */
}
.chats{   
 overflow: auto;
 margin: 10px; 
 height : 750px;
}
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.form{
margin-left : 20px;
background-color: #f1f1f1;
}
    </style>
    <?php 
    session_start();
    include "../php/connect.php";

    if(isset($_POST['show'])||isset($_SESSION['to_user']))
    {
        $from_user = $_SESSION['username'];
        if(isset($_SESSION['to_user']))
        {
            $to_user = $_SESSION['to_user'];
        }
        else
        {
            $to_user = $_POST['to_user'];
        }
        if(isset($_POST['show'])){
            $_SESSION['to_user'] = $to_user;
        }
        $query = "SELECT * FROM rochak_messages WHERE (to_user = '$to_user' AND from_user = '$from_user') OR (to_user = '$from_user' AND from_user = '$to_user');";
        $r1 = $connection->query($query);
        $query1 = "SELECT * FROM rochak_users WHERE username = '$from_user' ;";
        $r = $connection->query($query1);
        $row1 = mysqli_fetch_assoc($r); 
        $query2 = "SELECT * FROM rochak_profiles WHERE uname = '$from_user' ;";
        $r2 = $connection->query($query2);
        $row2 = mysqli_fetch_assoc($r2);
    ?>
    <body>
    <div class="sidenav">
	<div class="sidenavContents">
    <img height="150" width="150" src="<?php echo $row2['image']; ?>" style = "margin-left: 25; margin-top:25px">
    <h2> Name: <?php echo $row2['fname'].' '.$row2['sname']; ?> </h2>
    <br> Greetings 
    <br> Email: <?php echo $row1['email']; ?>
    <br> Username: <?php echo $_SESSION['username']; ?>
    <br> Gender: <?php echo $row1['gender']; ?>
    <br><br><br><br>
    <a href = "">EDIT PROFILE</a>
    <a href = "">LOGOUT</a>
    <a href = "../php/dashboard.php">DASHBOARD</a>
	</div>
    </div>
    <div class = "main">
    <div class = "chats">
    <?php 
    if(mysqli_num_rows($r1)>0){
        while($row = mysqli_fetch_assoc($r1)){
            ?>
	    <div class = "message-box">
            <div class = "sender"> Sender: <?php echo $row['from_user']; ?> </div>
            <div class = "receiver"> Receiver: <?php echo $row['to_user']; ?> </div>
            <div class = "message">Message: <?php echo $row['message']; ?></div>
            <div class = "time">Time: <?php echo $row['date'];?> </div> 
            </div>
            <?php
        }

    }
     else{
         echo "Nothing to show now";
        }
    ?>
    </div>
    <div class = "form">
    <form action="../php/sendmessage.php" method="POST">
    <label for = "message" style= "margin-left: 20px;">Message</label><br>
    <input id = "message" name = "message" style="width:70%; margin-left: 20px; margin-top: 5px ; margin-bottom: 20px; ">
    <span>
    <input type = "submit" class ="btn" name = "send" id = "send" value="send" style="margin-left:15px;">
    </span>
    </div>
    </div>
    <?php
    }
    else{
        header("Location: ../php/dashboard.php");
    }
    ?>
 </body>
 </html>
