function inputCheck(input){
    if(input.trim().length==0){
        document.getElementById("error").innerHTML = "<p>Enter Username and Password</p>"
        document.getElementById("login").disabled = true;
    }
    else{
        document.getElementById("error").innerHTML ="";
        
    }

    var val1 = document.getElementById("username").value;
    var val2 = document.getElementById("password").value;
    
    if(val1.trim().length !==0 && val2.length !==0){
        document.getElementById("login").disabled = false;
    }
     

}
