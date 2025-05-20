<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&S Clothing</title>
    <style>

        footer {
            padding: 30px 10px;
            font-family: 'Arial', sans-serif;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2); 
            margin-top: auto; 
        }

        .footer-content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            text-align: center;
        }

        .contact-info {
            flex: 1;
            margin-bottom: 20px;
        }

        .contact-info p {
            font-size: 18px;
            margin: 5px 0;
        }

        .contact-info a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-info a:hover {
            color: #8A2BE2; 
            text-decoration: underline;
        }

        .map {
            flex: 1;
            margin-top: 10px;
        }

        .map iframe {
            border: 2px solid #8A2BE2;
            border-radius: 15px;
            width: 100%;
            max-width: 300px;
            height: 200px;
        }
        
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
            }

            .contact-info, .map {
                margin-bottom: 20px;
            }

            .map iframe {
                width: 90%;
                height: 250px;
            }
        }

    </style>
    
</head>
<body>

    <footer>
        <div class="footer-content">
            <div class="contact-info">
                <p>Contact us:</p>
                <p>Tel: <a href="tel:+1234567890">+123 456 7890</a></p>
                <p>Email: <a href="mailto:info@dsclothing.com">info@dsclothing.com</a></p>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=..." allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </footer>

</body>
</html>
