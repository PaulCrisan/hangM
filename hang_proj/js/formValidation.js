// adaugam classa div-ului cu warning ce vine din php pentru a arata ca si cel din js
if (document.getElementById("pwarn").innerHTML != 0) document.getElementById('div1').classList.add('padd');

//stergem warningul daca este afisat
function checkWarning() {
    var w = document.getElementById("div2").style.display;

    if (w != "none" || document.getElementById("pwarn").innerHTML != 0) {
        document.getElementById('div1').style.display = "none";
        document.getElementById("div2").style.display = "none";
    }
}
// validarea formularului inainte de submit
function validateF() {
    if (document.getElementById('div1').style.display != "none")
        document.getElementById('div1').style.display = "none";
    if (userV() && passV()) return true;
    return false;
}
//verificari input pasword in onBlur
function passV() {
    var pass = document.getElementById('pass').value;
    if (pass.length == 0) {
        showWarning("Password field empty");
        return false;
    } else if (pass.length < 2) {
        showWarning("Password must be minimum 3 characters long");
        return false;
    }
    return true;

}
//verificari input user in onBlur
function userV() {
    var user = document.getElementById('user').value;
    if (user.length == 0) {
        showWarning("User field empty");
        return false;
    } else if (user.indexOf(' ') !== -1) {
        showWarning("No spaces allowed");
        return false;
    } else if (!user.match(/^[A-Za-z0-9]+$/)) {
        showWarning("Only numbers and letters for username");
        return false;
    }

    return true;

}

function showWarning(s) {
    document.getElementById("div2").style.display = "block";
    document.getElementById('warning').innerHTML = s;
}
