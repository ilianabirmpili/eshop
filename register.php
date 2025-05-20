<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing - Register</title>
    <style>
        form {
            max-width: 500px;
            margin: 0 auto; 
            padding: 20px;
            background-color: #f9f9f9; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            font-family: Arial, sans-serif;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form label {
            display: block; 
            margin-bottom: 8px;
            font-size: 16px;
            color: #333;
        }

        form input,
        form textarea {
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
            background-color: #8A2BE2; 
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #6A1BBE; /
        }
        @media (max-width: 768px) {
            form {
                padding: 15px;
            }

            form button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <?php
    session_start();
    include 'header.php';
    include 'db.php';
    ?>
    <main> <!-- register form -->
        <form id="register-form" method="post" action="register_process.php">
            <h2>Register</h2>
            <label for="register-first-name">First Name:</label>
            <input type="text" id="register-first-name" name="first_name" required>
            
            <label for="register-last-name">Last Name:</label>
            <input type="text" id="register-last-name" name="last_name" required>
            
            <label for="register-username">Username:</label>
            <input type="text" id="register-username" name="username" required>
            
            <label for="register-password">Password:</label>
            <input type="password" id="register-password" name="password" required>
            
            <label for="register-email">Email:</label>
            <input type="email" id="register-email" name="email" required>
            
            <label for="register-address">Address:</label>
            <textarea id="register-address" name="address"></textarea>
            
            <button type="submit">Register</button>
        </form>
    </main>
    <?php include 'footer.php'; ?>
</body>
</html>
