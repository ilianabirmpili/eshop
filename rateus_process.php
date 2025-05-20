<?php
session_start();
include 'db.php';
include 'functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user']['id'])) {
    // User not logged in, redirect to login page or show an error
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];
$user_has_orders = userHasOrders($mysqli, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user has made an order
    if ($user_has_orders) {
        $comment = trim($_POST['comment']);
        if (!empty($comment)) {
            // Add the comment
            addComment($mysqli, $user_id, $comment);
            // Redirect to rateus.php after successful submission
            header("Location: rateus.php?status=success");
            exit();
        } else {
            // Comment is empty, redirect with error message
            header("Location: rateus.php?status=error&message=Comment cannot be empty.");
            exit();
        }
    } else {
        // User has not made any orders, redirect with error message
        header("Location: rateus.php?status=error&message=You must have made an order to leave a comment.");
        exit();
    }
}

// Redirect if not a POST request or other issues
header("Location: rateus.php");
exit();
?>
