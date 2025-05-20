<?php
session_start();
include 'db.php'; // Connect to the database

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    echo 'You must be logged in to remove items from your cart.';
    exit();
}

$userId = $_SESSION['user']['id'];
$productId = $_POST['product_id'];

// Remove the product from the cart
$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $userId, $productId);
$stmt->execute();

echo 'Product removed from cart!';
header("Location: cart.php"); // Redirect to the cart page
?>
