<?php
session_start(); // Start session
include 'header.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing - Login/Register</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        main {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }

        h1, h2 {
            text-align: center;
            color: #333; 
        }

        form {
            margin-bottom: 20px; 
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-size: 16px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #1c19ee; 
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0b0a67; 
        }


        h3 {
            text-align: center;
            color: #333;
        }

        h3 a {
            color: #80e6e6; 
            text-decoration: none;
        }

        h3 a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <h1>Login</h1>
        <?php if (isset($_SESSION['login_error'])): ?>
            <p class="error-message"><?php echo $_SESSION['login_error']; ?></p>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>
        <form id="login-form" method="post" action="login_process.php"> 
            <label for="login-username">Username:</label>
            <input type="text" id="login-username" name="username" required>
            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <h3>Don't have an account? <a href="register.php">Register</a> now!</h3>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
