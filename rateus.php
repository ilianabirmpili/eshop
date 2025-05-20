<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing - Rate Us</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5; 
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

    
        .comments {
            margin-bottom: 20px;
        }

        .comments table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .comments th, .comments td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .comments th {
            background-color: #abd9fa; 
            color: #fff;
        }

        .comments tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .comments tr:hover {
            background-color: #e9e9e9;
        }


        .add-comment {
            margin-top: 20px;
        }

        .add-comment form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .add-comment textarea {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            min-height: 100px;
            resize: vertical;
        }

        .add-comment button {
            padding: 10px 20px;
            background-color: #80e6e6; 
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-comment button:hover {
            background-color: #6A1BBE; 
        }

        .comments p {
            text-align: center;
            font-size: 18px;
            color: #777;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
<?php
    session_start();
    include 'db.php';
    include 'functions.php';

    // Get all comments
    $comments = getAllComments($mysqli);

    // Check if user is logged in and has orders
    $user_id = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    $user_has_orders = $user_id && userHasOrders($mysqli, $user_id);

    // Handle comment submission status
    $status = isset($_GET['status']) ? $_GET['status'] : null;
    $message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : '';

    ?>
    <?php include 'header.php'; ?>

    <main>
        <h1>Rate Us</h1>
        
        <!-- Display status message -->
        <?php if ($status === 'success'): ?>
            <p class="success">Your comment has been submitted successfully!</p>
        <?php elseif ($status === 'error'): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Display all comments -->
        <section class="comments">
            <h2>Comments from Users</h2>
            <?php if (!empty($comments)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Comment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($comment['username']); ?></td>
                                <td><?php echo htmlspecialchars($comment['comment']); ?></td>
                                <td><?php echo htmlspecialchars($comment['created_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No comments available.</p>
            <?php endif; ?>
        </section>

        <!-- Comment submission form if user is logged in and has orders -->
        <?php if ($user_has_orders): ?>
            <section class="add-comment">
                <h2>Leave a Comment</h2>
                <form action="rateus_process.php" method="post">
                    <textarea name="comment" placeholder="Write your comment here..." required></textarea>
                    <button type="submit">Submit</button>
                </form>
            </section>
        <?php else: ?>
            <p>You must be logged in and have made an order to leave a comment.</p>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>