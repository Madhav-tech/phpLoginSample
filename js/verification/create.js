function inputCheckCreate() {
    var val1 = document.getElementById("firstname").value;
    var val2 = document.getElementById("email").value;
    var val3 = document.getElementById("new-username").value;
    var val4 = document.getElementById("new-password").value;

    //password format check


    if (val1.trim().length == 0 || val2.trim().length == 0 || val3.trim().length == 0 || val4.length == 0) {
        document.getElementById("error").innerHTML = "<p>Enter required Field</p>"
        document.getElementById("create").disabled = true;

    }
    else {
        document.getElementById("create").disabled = false;
        document.getElementById("error").innerHTML = "";
        //verify Username and password before submitting
        checkUserexist(val3);
        passwordRegExCheck(val4);

    }
}

function checkUserexist(user) {
    const xmlhttpRequest = new XMLHttpRequest();
    xmlhttpRequest.onload = function () {
        document.getElementById("userExist").innerHTML = this.responseText;
        if (this.responseText.includes('exist')) {
            document.getElementById("create").disabled = true;
        }
    }
    xmlhttpRequest.open("GET", "user/userExist.php?username=" + user);
    xmlhttpRequest.send();

}
function passwordRegExCheck(password) {
    if (password.length >= 6 && password.length <= 9) {

        var pattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,9}$/;
        //^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$
        if (pattern.test(password)) {
            document.getElementById("pwd-error").innerHTML = "";
        }

        else {
            document.getElementById("pwd-error").innerHTML = "Password must have at least <ul><li>One lowercase</li><li>One uppercase</li> <li>One digit </li>";
            document.getElementById("create").disabled = true;
        }
    }
    else {
        document.getElementById("pwd-error").innerHTML = "Password length must be 6 to 9 character long";
        document.getElementById("create").disabled = true;
    }
}