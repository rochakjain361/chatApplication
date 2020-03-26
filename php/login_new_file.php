<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/loginAndRegister.css" type="text/css">
</head>
<body>
<script src="../js/login.js"></script>
<div class="container">
    <div class ="container-heading">
        Chat Room(Php Assignment)
    </div>
    <div class ="form-Body">
        <form action="../php/login.php" method="POST" onsubmit="return validation()">
            <div class = "form-group">
                <label> Name/UserName: </label><br>
                <input type="text" name="username" id="name" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username']; } ?>" autocomplete="off">
                <div id="nameWarning" class="text_danger"></div>
            </div>
            <div class = "form-group"><div>
                <label> Password: </label><br>
                <input type="password" name="password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; } ?>" autocomplete="off" id="password"></div><div>
                <input type="checkbox" onclick="showPassword()" style="width: 2%"><span>Show Password</span></div>
                <div id="passwordWarning" class="text_danger"></div>
            </div>
            <div class = "form-group">
                 <input type="checkbox" name="remember" style="width: 2%"><span>Remember Me</span>
       		</div>
            <div class="form-group" style="margin-left: 1em; display: flex; justify-content: center">
                 <input type="submit" style="width: 40%;height: 2em; font-size: 0.9em" autocomplete="off" id="submit">
            </div>
            <div style = "display: flex; flex-flow: row; justify-content: center; align-items: center; ">DON'T HAVE AN ACCOUNT? <a href = "../html/register.html">REGISTER HERE</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

