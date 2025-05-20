<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing</title>
    <style>
        header {
            font-family: Arial, sans-serif;
            background-color: #fff;
            padding: 20px 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 24px;
            color: #333;
            text-decoration: none;
        }
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }

        .nav-menu li {
            margin: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .nav-menu a:hover {
            color: #6c5ce7; 
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
            flex-direction: column;
            gap: 5px;
        }

        .hamburger-menu .bar {
            width: 30px;
            height: 3px;
            background-color: #333;
            border-radius: 3px;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #fff;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .mobile-menu .nav-menu {
            flex-direction: column;
            padding: 10px;
            margin: 0;
            gap: 10px;
        }

        .mobile-menu .nav-menu li {
            margin: 0;
        }

        .mobile-menu .nav-menu a {
            padding: 10px;
            display: block;
            color: #333;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .mobile-menu .nav-menu a:hover {
            background-color: #f4f4f4;
        }

        @media (max-width: 768px) {
            /*Hide the desktop menu and show the hamburger menu*/
            .nav-menu {
                display: none;
            }

            .hamburger-menu {
                display: flex;
            }

            .mobile-menu.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <a href="home.php">D&S Clothing</a>
            </div>
            <!-- Navigation Menu -->
            <nav>
                <ul class="nav-menu">
                    <li><a href="home.php">Home</a></li>
                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Display logout link if user is logged in -->
                        <li><a href="logout.php">Logout</a></li>
                    <?php else: ?>
                        <!-- Display login link if user is not logged in -->
                        <li><a href="login.php">Login</a></li>
                    <?php endif; ?>
                    <li><a href="cart.php">My Cart</a></li>
                    <li><a href="rateus.php">Rate Us</a></li>
                </ul>

                <!-- Hamburger Menu for Mobile -->
                <div class="hamburger-menu">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </nav>
        </div>
        <!-- Mobile Menu (to be toggled) -->
        <div class="mobile-menu">
            <ul class="nav-menu">
                <li><a href="home.php">Home</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
                <li><a href="cart.php">My Cart</a></li>
                <li><a href="rateus.php">Rate Us</a></li>
            </ul>
        </div>
    </header>

    <script>
        // Script to toggle the mobile menu visibility
        const hamburgerMenu = document.querySelector('.hamburger-menu');
        const mobileMenu = document.querySelector('.mobile-menu');

        hamburgerMenu.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
    </script>
</body>
</html>
