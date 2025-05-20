<?php
session_start();
include 'db.php'; // Connect to the database

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from the form
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $address = trim($_POST['address']);
    
    // Get the user ID from the session
    $user_id = $_SESSION['user']['id'];

    // Update the user's details in the database
    $query = "UPDATE users SET first_name = ?, last_name = ?, address = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sssi", $first_name, $last_name, $address, $user_id);
    
    if ($stmt->execute()) {
        // Update the session details with the new information
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['address'] = $address;

        // Redirect with a success message
        header('Location: cart.php?update=success');
    } else {
        // Redirect with an error message
        header('Location: cart.php?update=error');
    }
    exit();
}
?>
