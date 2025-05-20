<?php
session_start();
include 'db.php'; //connection with database

//get data from form 
$username = trim($_POST['username']);
$password = trim($_POST['password']);

//search user based on username
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && $password === $user['password']) {
     //if password is correct 
    $_SESSION['user'] = $user; //save user data
    header('Location: home.php'); //redirect to home page
} else {
    //if password is incorrect
    $_SESSION['login_error'] = 'Λάθος όνομα χρήστη ή κωδικός.';
    header('Location: login.php'); //redirect to login page
}
exit();
?>
