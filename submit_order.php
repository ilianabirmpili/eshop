<?php
session_start();
include 'db.php';
include 'functions.php';

// Ensure the user is logged in
if (!isset($_SESSION['user']['id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user']['id'];

// Get cart items for the user
$cartItems = getCartItems($mysqli, $userId);

// Ensure the cart is not empty
if (empty($cartItems)) {
    header('Location: cart.php?error=empty_cart');
    exit();
}

// Begin a transaction
$mysqli->begin_transaction();

try {
    // Insert order into purchases table
    $query = "INSERT INTO purchases (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    
    foreach ($cartItems as $item) {
        $stmt->bind_param("iii", $userId, $item['id'], $item['quantity']);
        $stmt->execute();
    }

    // Commit the transaction
    $mysqli->commit();

    // Clear cart items for the user
    $query = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    // Redirect to a success page or back to cart with success message
    header('Location: cart.php?order=success');
    exit();

} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $mysqli->rollback();
    // Log the error (you might want to do this in production)
    error_log("Order submission failed: " . $e->getMessage());
    // Redirect back to cart with an error message
    header('Location: cart.php?order=error');
    exit();
}
?>
