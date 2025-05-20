<?php
session_start();
include 'db.php'; // Σύνδεση με τη βάση δεδομένων
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //get data from form
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    //check for pre-existing username or email 
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        //user already exists - error message
        header('Location: register.php?error=exists');
        exit();
    }
        //create new user
        $query = "INSERT INTO users (first_name, last_name, username, password, email, address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ssssss", $first_name, $last_name, $username, $password, $email, $address);
        $stmt->execute();

        //login after successfully register
        $_SESSION['user'] = [
            'username' => $username,
            'email' => $email
        ];
        header('Location: home.php');
        exit();
    }

?>

