// location.href='logout.php';
console.log("i am logout function to log out user from websites ");
console.log("Hello World");
// Get the button element
const button = document.getElementById("LogOutBtn");

// Attach the gotoLogin function to the button's click event
button.addEventListener("click", logOut);

function logOut () {
window.location = 'logout.php';
}