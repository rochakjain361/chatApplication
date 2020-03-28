<?php
session_start();
include '../php/connect.php';
if(!($_SESSION['username'] == true)){
    header("Location: ../php/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/loginAndRegister.css" type="text/css">
</head>
<body>
<script src="../js/register.js"></script>
<div class="container">
    <div class ="container-heading">
        Edit Profile 
    </div>
    <div class ="form-Body">
        <form action="../php/editProflie.php" method="POST" onsubmit="return validation()">
            <div class = "form-group">
                <label>New First-Name:</label><br>
                <input type="text" name="fname" id = "fname" autocomplete="off" required>
            </div>
            <div class = "form-group">
                <label> New Last-Name:</label><br>
                <input type="text" name="lname" id = "lname" autocomplete="off" style="width: 88% ; height: 1.4em;" required >
            </div>
            <div class = "form-group">
                <label for="upload">Select your new avatar </label>
                <input class="upload" id = "uploadDp" type = "file"  name="profilePic" required> <br>
            </div>
            <div class = "form-group">
                <label> New Phone Number:</label><br>
                <input type="text" name="phoneNumber" id="phoneNumber" autocomplete="off" style="width: 88% ; height: 1.4em;" >
                <div id="phoneNumberWarning" class="text_danger"></div>
            </div>
           <div class = "form-group">
                <label>New Email: </label> <br>
                <input type="text" name="email" autocomplete="off" id="email">
                <div id="emailWarning" class="text_danger"></div>
            </div>
            <div class = "form-group"><div>
                <label>New Password: </label><br>
                <input type="password" name="password" autocomplete="off" id="password"></div><div>
                <input type="checkbox" onclick="showPassword()" style="width: 2%"><span>Show Password</span></div>
                <div id="passwordWarning" class="text_danger"></div>
            </div>
            <div class = "form-group">
                <label> Confirm Password:</label><br>
                <input type="password" name="conPass" autocomplete="off" id="conPassword">
                <div id="conPasswordWarning" class="text_danger"></div>
            </div>
            
            <div class="form-group" style="margin-left: 1em; display: flex; justify-content: center">
                 <input type="submit" style="width: 40%;height: 2em; font-size: 0.9em" autocomplete="off" id="submit">
            </div>
        </form>
    </div>
<?php
$username = $_SESSION['username'];
    if(isset($_POST['submit'])){
	    if(isset($_POST['fname'])){
		    $fname = $_POST['fname'];
		    if(preg_match("/^[a-zA-Z ]*$/", $fname)){
			    $fname=htmlspecialchars($fname);
			    $fname = mysqli_real_escape_string($connection,$firstname);
                $query1 = "UPDATE rochak_profiles SET fname = '$fname' WHERE uname = '$username';";
                $r = $connection->query($query1);
                if(!($r)){
                    header("Location: ../php/editProfile.php");
                }   
            }
        }
		    if(isset($_POST['lname'])){
			    $lname = $_POST['lname'];
			    if(preg_match("/^[a-zA-Z ]*$/", $_POST['lname'])){
				    $lname=htmlspecialchars($lname);
      				    $lname=mysqli_real_escape_string($connection,$lname);
                $query2 = "UPDATE rochak_profiles SET sname = '$lname' WHERE uname = '$username'';";
                $r2 = $connection->query($query2);
                if(!($r2)){
                    header("Location: ../php/editProfile.php");
                }   
            }
        }
        if(!empty($_FILES['profilePic'])){
            $myFile = $_FILES['profilePic'];
            $myFile_name = $_FILES['profilePic']['name'];
            $myFile_type = $_FILES['profilePic']["type"];
            $myFile_templocation = $_FILES['profilePic']["tmp_name"];
            $myFile_stor="../image/".$myFile_name;
            $ext = explode('.', $myFile_name);
            $actualExt=strtolower(end($ext));
            if($actualExt=='jpg'||$actualExt=='jpeg'||$actualExt=='png'){
                move_uploaded_file($myFile_templocation, $myFile_stor);
                $query3 = "UPDATE rochak_profiles SET image = '$myFile_stor' WHERE uname = '$username' ;"; 
                $r3=$connection->query($query3);
                if(!($r3)){
                    header("Location: ../php/editProfile.php");
                }
            }
        }
        if(isset($_POST['phoneNumber'])){
		if(preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/", $_POST['phoneNumber'])){
			$phoneNumber = $_POST['phoneNumber'];
			 $phoneNumber=htmlspecialchars($phoneNumber);
        		 $phoneNumber=mysqli_real_escape_string($conn,$phoneNumber);
                $query4 = "UPDATE rochak_users SET phoneNumber = '$phoneNumber' WHERE username = '$username';";
                $r4 = $connection->query($query4);
                if(!($r4)){
                    header("Location: ../php/editProfile.php");
            }
		}
	}
        if(isset($_POST['password']) && isset($_POST['conPass'])){
            if($_POST['password'] == $_POST['conPass']){
		    $password = $_POST['password'];
		    $password=htmlspecialchars($password);
        	    $password=mysqli_real_escape_string($connection,$password);
		    $password=password_hash($password,PASSWORD_BCRYPT);
		$query6 = "UPDATE rochak_users SET password = '$password' WHERE username = '$username';";
                    $r6 = $connection->query($query6);
                    if(!($r5)){
                        header("Location: ../php/editProfile.php");
                   }
                else{
                    header("Location: ../php/editProfile.php");
                }
            }
        }
	if(isset($_POST['email'])){
		$email=htmlspecialchars($email);
        	$email=mysqli_real_escape_string($connection,$email);
		if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST['email'])){
			$email = $_POST['email'];
                $query7 = "UPDATE rochak_users SET email = '$email' WHERE username = '$username';";
                $r7 = $connection->query($query7);
                if(!($r7)){
                    header("Location: ../php/editProfile.php");
                }
            }
        }
        header("Location: ../php/dashboard.php");
    }
    ?>
</div>
</body>
</html>

