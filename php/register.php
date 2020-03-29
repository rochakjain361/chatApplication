<?php
include '../php/connect.php';
$user = $email = $pwd = $conpwd = $gender = $phoneNumber = '';
if(isset($_POST['username']) && isset($_POST['phoneNumber']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['conPass']) ){
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $phoneNumber = $_POST['phoneNumber'];
    $conpwd = $_POST['conPass'];
    $gender = $_POST['gender'];
     if($conpwd == $pwd)
     {
        if(preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))
        {
            if(preg_match("/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/", $phoneNumber))
            {
                $query2 = "SELECT * FROM rochak_users WHERE ;"; #Username Check
                $r = $connection->query($query2);
                if(mysqli_num_rows($r) >= 1)
                {
                    header("Location: ../html/register.html");
                    die("USERNAME ALREADY TAKEN");
                }
                else
		{            
		    $user=htmlspecialchars($user);
		    $user=mysqli_real_escape_string($connection,$user);
		    $email=htmlspecialchars($email);
   	            $email=mysqli_real_escape_string($connection,$email);
		    $phoneNumber=htmlspecialchars($phoneNumber);
		    $phoneNumber=mysqli_real_escape_string($connection,$phoneNumber);
		    $gender=htmlspecialchars($gender);
		    $gender=mysqli_real_escape_string($connection,$gender);


                    $query3 = "SELECT * FROM rochak_users WHERE email = '$email';";#Email Check
                    $r2 = $connection->query($query3);
                    if(mysqli_num_rows($r2) >= 1)
                    {
                    header("Location: ../html/register.html"/*register.html page address*/);
                    die("EMAIL ALREADY TAKEN");
                    }
                    else
                    {   
			    $pwd=htmlspecialchars($pwd);
			    $pwd=mysqli_real_escape_string($connection,$pwd);
			    $pwd=password_hash($pwd,PASSWORD_BCRYPT);
                        $query4 = "INSERT INTO rochak_users (username, password, email, gender, phoneNumber) VALUES ('$user', '$pwd', '$email', '$gender', '$phoneNumber');";
                        $res = $connection->query($query4);         
                        header("Location: ../php/login_new_file.php");
                        die("User Signed Up");
                    }
                }
            }
            else
            {
                header("Location: ../html/register.html");
                die("Invalid Phone Number");
            }
        }
        else{
            header("Location: ../html/register.html");
            die("Invalid Email");
        }
    }
    else{
        header("Location: ../html/register.html");
        die("Passwords Don't Match");
    }
}
else{
    header("Location: ../html/register.html");
    die("Parameters not filled fully");
}
?>
