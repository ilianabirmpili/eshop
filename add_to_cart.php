<?php
session_start();
include 'db.php'; // Connect to the database

// Ensure the user is logged in
if (!isset($_SESSION['user'])) {
    echo 'You must be logged in to add items to your cart.';
    exit();
}

$userId = $_SESSION['user']['id'];
$productId = $_POST['product_id'];

// Check if the product is already in the cart
$query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $userId, $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the product is already in the cart, update the quantity
    $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
} else {
    // If the product is not in the cart, add it
    $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
}

echo 'Product added to cart!';
?>
