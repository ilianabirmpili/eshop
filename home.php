<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing</title>

    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            background-color: #abd9fa;
            padding: 20px;
            flex: 1;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin: 0 auto;
            max-width: 1200px;
        }

        .product {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
     
        }

        .product img {
            width: 100%;
            max-height: 200px;
            object-fit: contain; 
            border-radius: 8px;
        }

        .product h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #555;
        }

        .price {
            font-size: 18px;
            color: #27ae60;
            margin-bottom: 10px;
        }

        .availability {
            font-size: 16px;
            color: #555;
            margin-bottom: 10px;
        }

        .add-to-cart {
            background-color: #6c5ce7;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .add-to-cart:hover {
            background-color: #d40c5c;
        }

        /*Mobile responsiveness for smaller screen*/
        @media (max-width: 600px) {
            .products {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            }

            .add-to-cart {
                padding: 8px 16px; 
            }
        }
    </style>
 <!-- add to cart message pop-up-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.add-to-cart');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');

                    fetch('add_to_cart.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'product_id=' + encodeURIComponent(productId)
                    })
                    .then(response => response.text())
                    .then(result => {
                        alert(result);
                    });
                });
            });
        });

    </script>
</head>
<body>
        <?php
        session_start();
        include 'db.php';    // Database connection 
        include 'header.php'; //Navigation menu 
        include 'functions.php'; 

        $products = getAllProducts($mysqli); // Get all products from database
        ?>

        <main>
            <section class="products">
                <?php if (!empty($products)): ?>    
                    <?php foreach ($products as $product): ?>       
                        <div class="product">
                        <img src="product_images/<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"> <!-- add image from /product_images folder-->
                            <h2><?php echo ($product['name']); ?></h2>
                            <p class="price">Price: $<?php echo number_format($product['price'], 2); ?></p>
                            <p class="availability">Availability: <?php echo $product['availability'] ? 'In stock' : 'Out of stock'; ?></p>
                            
                            <?php if (isset($_SESSION['user'])): ?>  <!--Add to cart button only if user is logged in-->
                                <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                            <?php else: ?> 
                                <p>Please log in to add items to your cart.</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products available.</p>
                <?php endif; ?>
            </section>
        </main>

        <?php include 'footer.php'; ?> 
</body>
</html>
