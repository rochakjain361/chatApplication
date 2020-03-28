var user = document.getElementById('username').value;
var phoneNumber = document.getElementById('phoneNumber').value;
var email = document.getElementById('email').value;
var password = document.getElementById('password').value;
var conPassword = document.getElementById('conPassword').value;
var gender = document.getElementById('gender').value;
document.getElementById('nameWarning').innerHTML="";
document.getElementById('phoneNumberWarning').innerHTML="";
document.getElementById('emailWarning').innerHTML="";
document.getElementById('passwordWarning').innerHTML="";
document.getElementById('conPasswordWarning').innerHTML="";

function validation() {
    if(user === ""){
        document.getElementById('nameWarning').innerHTML="** Name Field can't be empty";
        return false;
    }
    if(user.length < 2 || user.length > 20){
        document.getElementById('nameWarning').innerHTML="** Name should have 2 to 20 letters only";
        return false;
    }
    if(!phoneNumber.match(/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/)){
        document.getElementById('phoneNumberWarning').innerHTML="** Enter a valid phone number";
        return false;
    }
    if(!email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
        document.getElementById('emailWarning').innerHTML="** Not a valid email please enter one";
        return false
    }
    if(password === ""){
        document.getElementById('passwordWarning').innerHTML="** Please fill the password it can't be empty";
        return false
    }
    if(password.length <= 8|| password.length >= 20){
        document.getElementById('passwordWarning').innerHTML="f** Password should contain characters between 8 and 20";
        return false
    }
    if(conPassword !== password){
        document.getElementById('conPasswordWarning').innerHTML ="** Re-Enter the correct password"
        return false
    }
    if(email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
            }
        };
	    request.open("GET","../php/validation.php?email="+email, true);
	    request.send();
	    console.log("Email Request Sent");
    }
    if(!(user.length < 2 || user.length > 20)){
        var request2 = new XMLHttpRequest();
        request2.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
            }
        };
        request2.open("GET","../php/validation.php?user="+user, true);
        request2.send();
	    console.log("Username Request Sent");
    }
}
function showPassword(){
    var x = document.getElementById('password');
    var y = document.getElementById('conPassword');
    if(x.type === "password"){
        x.type = "text";
        y.type = "text";
    }
    else {
        x.type = "password";
        y.type = "password";
    }
}
