<?php
session_start();
include '../php/connect.php';
if(!($_SESSION['username'] == true)){
    header("Location: ../php/login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Title </title>
        <link rel="stylesheet" href="../css/loginAndRegister.css" type="text/css">
    </head>
    <body>
        <div class="container">
    <div class ="container-heading">
        Registration to Chat Room
    </div>
    <div class ="form-Body">
        <form action="../php/profileNew.php" method="POST" enctype = "multipart/form-data">
            <div class = "form-group">
                <label>First-Name:</label><br>
                <input type="text" name="fname" id = "fname" autocomplete="off" required>
            </div>
            <div class = "form-group">
                <label>Last-Name:</label><br>
                <input type="text" name="lname" id = "lname" autocomplete="off" style="width: 88% ; height: 1.4em;" required >
            </div>
            <div class = "form-group">
                <label for="upload">Select your avatar </label>
                <input class="upload" id="uploadDp" type = "file" name="profilePic" required > <br>
             </div>
            <div class="form-group" style="margin-left: 1em; display: flex; justify-content: center">
                <input type="submit" name="submit" value="submit" style="width: 40%;height: 2em; font-size: 0.9em" autocomplete="off" id="insert">
            </div>
        </form>
    </div>
    <?php 
    
    if(isset($_POST['submit'])){
        if(empty($_POST['fname']) || empty($_POST['lname']) || empty($_FILES['profilePic'])){
            echo "<script>alert('Some input missing!!')</script>";
        }
        else{
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
	    $uname = $_SESSION['username'];
	    $query0 = "SELECT * FROM rochak_profiles WHERE uname = '$uname';";
	    $query_run0 = $connection->query($query0);
	    $count = mysqli_num_rows($query_run0);
	    if($count >= 1){
		    echo "<script>alert('Profile already created')</script>";
		    header("Location: ../php/dashboard.php");
	    }
	    else{
            $myFile = $_FILES['profilePic'];
            $myFile_name = $_FILES['profilePic']['name'];
            $myFile_type = $_FILES['profilePic']['type'];
            $myFile_templocation = $_FILES['profilePic']['tmp_name'];
            $myFile_stor="../image/".$myFile_name;
            $ext = explode('.', $myFile_name);
            $actualExt=strtolower(end($ext));
            if($actualExt=='jpg'||$actualExt=='jpeg'||$actualExt=='png')
            {
                move_uploaded_file($myFile_templocation, $myFile_stor);
                $query = "INSERT INTO rochak_profiles(uname, fname, sname, image) VALUES ('$uname', '$fname', '$lname', '$myFile_stor');"; 
                $query_run=$connection->query($query);
                if($query_run){
                    header("Location: ../php/dashboard.php");
                }
                else{
                    echo "<script>alert('Try Again Later')</script>";
                }
            }
            else{
                echo "<script>alert('Check Extension of the uploaded file'+'$actualExt' +'is the extension')</script>";
            }
	    }
	}
    }
    ?>
</body>
</html>
