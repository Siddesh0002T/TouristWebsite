// location.href='logout.php';
console.log("i am login button which throw user to login page where user able to login by using thier email and pass if user is new on our website so user can able to register it self on our webbsite");
console.log("Hello World");
// Get the button element
const button = document.getElementById("LogIn");

// Attach the gotoLogin function to the button's click event
button.addEventListener("click", logIn);

function logIn () {
window.location = './modules/login.php';
}