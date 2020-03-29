<?php
session_start();
include '../php/connect.php';
if(!($_SESSION['username'] == true)){
    header("Location: ../php/login.php");
}
$username = $_SESSION['username'];
            if(isset($_POST['fname'])){
                    $fname = $_POST['fname'];
                    if(preg_match("/^[a-zA-Z ]*$/", $fname)){
			    $fname = htmlspecialchars($fname);
                            $fname = mysqli_real_escape_string($connection,$fname);
                $query1 = "UPDATE rochak_profiles SET fname = '$fname' WHERE uname = '$username';";
                $r = $connection->query($query1);
		if(!($r)){
			echo('<script> alert("ERROR 1")</script>');
                    header("Location: ../html/editProfile.html");
                }
		    }
	    }
if(empty($_POST['photo'])){
}
else{
	$image = $_FILES['photo'];
	$img_name=$image['name'];
	$tmp_dir = $image['tmp_name'];
	$img_location = "../image/".$img_name;
	$type = $image['type'];
	if($type=="image/jpeg"||$type=="image/png"||$type=="image/jpg")
	{
		move_uploaded_file($tmp_dir,$img_location);
		$query3 = "UPDATE rochak_profiles SET image = '$image_location' WHERE uname = '$username';";
                                    $r3 = $connection->query($query3);
                if(!($r3)){
                        echo('<script> alert("ERROR 3")</script>');
                    header("Location: ../html/editProfile.html");
                         }
	}
}
                    if(isset($_POST['lname'])){
                            $lname = $_POST['lname'];
                            if(preg_match("/^[a-zA-Z ]*$/", $lname)){
                                    $lname=htmlspecialchars($lname);
                                    $lname=mysqli_real_escape_string($connection,$lname);
                $query2 = "UPDATE rochak_profiles SET sname = '$lname' WHERE uname = '$username';";
				    $r2 = $connection->query($query2); 
		if(!($r2)){
			echo('<script> alert("ERROR 2")</script>');
                    header("Location: ../html/editProfile.html");
	
		         }
		       }
		    }
		    
          if(isset($_POST['phoneNumber'])){
                if(preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/", $_POST['phoneNumber'])){
                        $phoneNumber = $_POST['phoneNumber'];
                         $phoneNumber=htmlspecialchars($phoneNumber);
                         $phoneNumber=mysqli_real_escape_string($connection,$phoneNumber);
                $query4 = "UPDATE rochak_users SET phoneNumber = '$phoneNumber' WHERE username = '$username';";
                $r4 = $connection->query($query4);
		if(!($r4)){
			echo('<script> alert("ERROR 4")</script>');
                    header("Location: ../html/editProfile.html");
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
		    if(!($r6)){
			    echo('<script> alert("ERROR 5")</script>');
                        header("Location: ../html/editProfile.html");
                   }
		    else{
			    echo('<script> alert("ERROR 7")</script>');
                    header("Location: ../html/editProfile.html");
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
			echo('<script> alert("ERROR 6")</script>');
                    header("Location: ../html/editProfile.html");
                }
            }
        }
        header("Location: ../php/dashboard.php");
    ?>
