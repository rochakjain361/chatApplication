<?php
session_start();
include '../php/connect.php';
if(isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
    $q1 = "SELECT * FROM rochak_users WHERE username = '$username';";
    $r1 = $connection->query($q1);
    $row1 = mysqli_fetch_assoc($r1);
    $q2 = "SELECT * FROM rochak_profiles WHERE uname = '$username';";
    $r2 = $connection->query($q2);
    $row2 = mysqli_fetch_assoc($r2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/loginAndRegister.css" type="text/css">
</head>
<body>

<div class="container">
    <div class ="container-heading">
        Edit Profile
    </div>
    <div class ="form-Body">
        <form action="../php/editProfile.php" method="POST" onsubmit="return E-Validation()">
            <div class = "form-group">
                <label>New First-Name:</label><br>
                <input type="text" name="fname" id = "fname" autocomplete="off" value = " <?php echo $row2['fname']; ?>">
            </div>
            <div class = "form-group">
                <label> New Last-Name:</label><br>
                <input type="text" name="lname" id = "lname" autocomplete="off" style="width: 88% ; height: 1.4em;" value = " <?php echo $row2['sname'];?>" >
            </div>
            <div class = "form-group">
                <p> Current Profile Picture </p>
                <img height = "100" width = "100" src = "<?php echo $row2['image']; ?> " > <br>
                <label for="upload">Select your new avatar </label>
                <input class="upload" type = "file" name="photo" id = "photo"><br>
            </div>
            <div class = "form-group">
                <label> New Phone Number:</label><br>
                <input type="text" name="phoneNumber" id="ephoneNumber" autocomplete="off" style="width: 88% ; height: 1.4em;" value ="<?php echo $row1['phoneNumber']; ?>">
                <div id="ephoneNumberWarning" class="text_danger"></div>
            </div>
           <div class = "form-group">
                <label>New Email: </label> <br>
                <input type="text" name="email" autocomplete="off" id="eemail" value = "<?php echo $row1['email']; ?>">
                <div id="eemailWarning" class="text_danger"></div>
            </div>
            <div class = "form-group"><div>
                <label>New Password: </label><br>
                <input type="password" name="password" autocomplete="off" id="epassword"></div><div>
                <input type="checkbox" onclick="showPassword()" style="width: 2%"><span>Show Password</span></div>
                <div id="epasswordWarning" class="text_danger"></div>
            </div>
            <div class = "form-group">
                <label> Confirm Password:</label><br>
                <input type="password" name="conPass" autocomplete="off" id="econPassword">
                <div id="econPasswordWarning" class="text_danger"></div>
            </div>

            <div class="form-group" style="margin-left: 1em; display: flex; justify-content: center">
            <input type="submit" style="width: 40%;height: 2em; font-size: 0.9em" autocomplete="off" id="submit">
            </div>
        </form>
    </div>
</div>
<script>
var phoneNumber = document.getElementById('ephoneNumber').value;
var email = document.getElementById('eemail').value;
var password = document.getElementById('epassword').value;
var conPassword = document.getElementById('econPassword').value;
document.getElementById('ephoneNumberWarning').innerHTML="";
document.getElementById('eemailWarning').innerHTML="";
document.getElementById('epasswordWarning').innerHTML="";
document.getElementById('econPasswordWarning').innerHTML="";

function E-Validation(){
    if(!phoneNumber.match(/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/)){
        document.getElementById('ephoneNumberWarning').innerHTML="** Enter a valid phone number";
        return false;
    }
    if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
        document.getElementById('eemailWarning').innerHTML="** Not a valid email please enter one";
        return false
    }
    if(password === ""){
        document.getElementById('epasswordWarning').innerHTML="** Please fill the password it can't be empty";
        return false
    }
    if(password.length <= 8|| password.length >= 20){
        document.getElementById('epasswordWarning').innerHTML="f** Password should contain characters between 8 and 20";
        return false
    }
    if(conPassword !== password){
        document.getElementById('econPasswordWarning').innerHTML ="** Re-Enter the correct password"
        return false
    }
}
function showPassword(){
    var x = document.getElementById('epassword');
    var y = document.getElementById('econPassword');
    if(x.type === "password"){
        x.type = "text";
        y.type = "text";
    }
    else {
        x.type = "password";
        y.type = "password";
    }
}
</script>
</body>
</html>
<?php
}
else {
	header("Location: dashboard.php");
}
?>
