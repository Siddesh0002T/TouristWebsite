console.log("Hello World");
/*
function gotoLogin () {
    console.log("GoToLogIn")
    window.location = "../../modules/login.php";
}
*/

console.log("Hello World");
// Get the button element
const button = document.getElementById("myButton");

// Attach the gotoLogin function to the button's click event
button.addEventListener("click", gotoLogin);

function gotoLogin () {
window.location = 'login.php';
}
