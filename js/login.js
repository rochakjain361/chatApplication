function validation() {
    let user = document.getElementById('name').value;
    let password = document.getElementById('password').value;
    document.getElementById('nameWarning').innerHTML="";
    document.getElementById('passwordWarning').innerHTML="";
    if(user === ""){
        document.getElementById('nameWarning').innerHTML="** Name Field can't be empty";
        return false;
    }
    if(user.length < 2 || user.length > 20){
        document.getElementById('nameWarning').innerHTML="** Name should have 2 to 20 letters only";
        return false;
    }
    if(password === ""){
        document.getElementById('passwordWarning').innerHTML="** Please fill the password it can't be empty";
        return false
    }
    if(password.length <= 8|| password.length >= 20){
        document.getElementById('passwordWarning').innerHTML="** Password should contain characters between 8 and 20"
        return false
    }
}
function showPassword(){
    var x = document.getElementById('password');
    if(x.type === "password"){
        x.type = "text";
    }
    else {
        x.type = "password";
    }
}
