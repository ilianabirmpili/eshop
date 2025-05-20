<?php
//Function to get all products from the database
function getAllProducts($mysqli) {
    $query = "SELECT id, name, price, availability, image_url FROM products"; 
    $result = $mysqli->query($query); //Execute the query

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC); //Get all rows as an array
    } else {
        echo "Error: " . $mysqli->error;
        return []; //Return an empty array in case of an error
    }
}


//Function to get all items in a user's cart
function getCartItems($mysqli, $userId) {
    $query = "SELECT p.id, p.name, p.price, c.quantity 
              FROM cart c
              JOIN products p ON c.product_id = p.id
              WHERE c.user_id = ?"; // SQL query to join cart and products tables

    $stmt = $mysqli->prepare($query); //Prepare the query
    $stmt->bind_param("i", $userId); 
    $stmt->execute(); 
    $result = $stmt->get_result(); //Get the result

    if (!$result) {
        die("Query failed: " . $mysqli->error); //Terminate script if query fails
    }

    return $result->fetch_all(MYSQLI_ASSOC); //Return the result as an array
}

// Function to get all comments along with the username of the user
function getAllComments($mysqli) {
    $query = "SELECT c.comment, c.created_at, u.username 
              FROM comments c 
              JOIN users u ON c.user_id = u.id 
              ORDER BY c.created_at DESC"; // SQL query to join comments and users tables and order by date
    $result = $mysqli->query($query); //Execute the query
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : []; // Return the result or an empty array if the query fails
}

//Function to add a new comment by a user
function addComment($mysqli, $user_id, $comment) {
    $query = "INSERT INTO comments (user_id, comment) VALUES (?, ?)"; // SQL query to insert a new comment
    $stmt = $mysqli->prepare($query); 
    $stmt->bind_param('is', $user_id, $comment); 
    $stmt->execute(); 
}

//Function to check if user has any orders
function userHasOrders($mysqli, $user_id) {
    $query = "SELECT COUNT(*) AS total_orders FROM purchases WHERE user_id = ?"; // SQL query to count the user's orders
    $stmt = $mysqli->prepare($query); //Prepare the query
    $stmt->bind_param('i', $user_id); 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
    $data = $result->fetch_assoc(); 
    return $data['total_orders'] > 0; // Return true if the user has orders, otherwise false
}
?>
