<style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
        }

        main {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .cart {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #8A2BE2; 
            color: #fff;
            font-size: 1.1em;
        }

        td {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #f1f1f1;
        }

        .remove-from-cart {
            background-color: #FF6F61; 
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .remove-from-cart:hover {
            background-color: #e55b4f; 
        }

        .total {
            font-size: 1.5em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }

        .place-order-btn {
            display: block;
            width: auto; 
            padding: 10px 15px; 
            background-color: #abd9fa; 
            color: #333;
            border: none;
            border-radius: 5px;
            font-size: 1em; 
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
            margin-top: 20px;
}

        .place-order-btn:hover {
    background-color: #3ca6f3; 
}
        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            color: #777;
            margin-top: 20px;
        }


        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        form input, form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button {
            padding: 10px 20px;
            background-color: #abd9fa; 
            color: #333;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #3ca6f3; 
        }
    </style>
</head>
<body>

<?php
    session_start();
    include 'db.php';
    include 'functions.php';
    include 'header.php';

    // Ensure the user is logged in
    if (!isset($_SESSION['user']['id'])){
        echo "You must be logged in to view your cart.";
    
        exit();
    }
 
    $userId = $_SESSION['user']['id'];
    $cartItems = getCartItems($mysqli, $userId);

    // calucate cost before discount
    $initialAmount = 0;

    foreach ($cartItems as $item) {
        $initialAmount += $item['price'] * $item['quantity'];
    }

    // Get random discount
    $discountPercentage = rand(10, 30) / 100;

    // Calculate final cost
    $finalAmount = $initialAmount - ($initialAmount * $discountPercentage);


    // Update user details if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['last_name']);
        $address = trim($_POST['address']);
        
        $query = "UPDATE users SET first_name = ?, last_name = ?, address = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("sssi", $first_name, $last_name, $address, $userId);
        $stmt->execute();
        
        // Update session data
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['address'] = $address;

        exit();
    }
?>

<main>
    <h1>My Cart</h1>
    <section class="cart">
        <?php if (!empty($cartItems)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>
                                <form method="post" action="remove_from_cart.php">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" class="remove-from-cart">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <p class="total">Initial Amount: $<?php echo number_format($initialAmount, 2); ?></p>
            <p class="total">Discount (<?php echo $discountPercentage * 100; ?>%): -$<?php echo number_format($initialAmount * $discountPercentage, 2); ?></p>
            <p class="total">Final Amount to Pay: $<?php echo number_format($finalAmount, 2); ?></p>
            <form action="submit_order.php" method="post">
                <button type="submit" class="place-order-btn">Submit Order</button>
            </form>
        <?php else: ?>
            <p class="empty-cart">Your cart is empty.</p>
        <?php endif; ?>

        <h2>Update Your Details</h2>
        <form method="post">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($_SESSION['user']['first_name']); ?>" required>
            
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($_SESSION['user']['last_name']); ?>" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo htmlspecialchars($_SESSION['user']['address']); ?></textarea>
            
            <button type="submit">Update</button>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>