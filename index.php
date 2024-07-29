<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Web Page</title>
    <style>
        /* Reset some default styles and set a base font size */
        body, h1, h2, p {
            margin: 0;
            padding: 0;
        }

        body {
            /*font-family: Arial, sans-serif;*/
            font-family: Bahnschrift, sans-serif;
            background-color: #f0f0f0;
            color: #FFFFFF;
        }

        /* Define a container for the entire page */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #1e1f22;
            box-shadow: 0 2px 5px rgb(14, 45, 63);
        }

        /* Header styling */
        header {
            width: 100%;
            background-color: #0e2d3f;
            color: #FFFFFF;
            padding: 20px;
            border: #FFFFFF;
        }

        /* Sidebar styling */
        .sidebar {
            flex: 1.45;
            background-color: #1e1f22;
            color: #FFFFFF;
            padding: 20px;
            padding-left: 20px; /* Reset default padding on the left */
        }

        /* Styling for the list inside the sidebar */
        .sidebar ul {
            padding-left: 0px; /* Add padding to align with the sidebar title, adjust as needed */
            list-style-type: none; /* Remove default list bullets */
            margin: 0; /* Reset default margins */
        }

        /* Styling for list items */
        .sidebar li {
            margin-bottom: 10px; /* Spacing between buttons */
        }

        /* Styling for links/buttons */
        .sidebar a {
            display: block; /* Change to block to fill the space of the li */
            padding: 10px 15px; /* Padding inside the button */
            background-color: #0e2d3f; /* Button color */
            color: #FFFFFF; /* Text color */
            text-decoration: none; /* Remove underline from links */
            border-radius: 5px; /* Rounded corners for buttons */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }

        .sidebar a:hover {
            background-color: #2874a6; /* Darker button color on hover */
        }

        /* Games of the Month styling */
        .games-of-month {
            /* Use flexbox to lay out children horizontally */
            display: flex;
            justify-content: space-around; /* This will space out the images evenly */
            align-items: center; /* This will vertically align the images if they are of different heights */
            flex-wrap: wrap; /* This will allow items to wrap to the next line on smaller screens */
            gap: 0px;
        }

        /* Individual game image styling */
        .game-image {
            margin-right: 10px; /* Add some space to the right of each image */
            flex: 0 0 auto; /* Do not grow or shrink the images, and do not allow them to wrap individually */
        }


        /* Clear the margin for the last image */
        .game-image:last-child {
            margin-right: 0;
        }


        /* Main content styling */
        .main-content {
            flex: 20;
            padding-right: 180px;
            display: flex; /* Use flexbox for layout */
            flex-direction: column; /* Stack children vertically */
            align-items: center; /* Center items horizontally */
            justify-content: center; /* Center items vertically */
            text-align: center; /* Center text */
        }

        /* Footer styling */
        footer {
            width: 100%;
            background-color: #0e2d3f;
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
        }

        /* Media query for tablets */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .sidebar, .main-content {
                flex: none;
                width: 100%;
            }
        }

        /* Media query for phones */
        @media (max-width: 480px) {
            header, footer {
                text-align: center;
                background-color: #ffffff;
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <?php
        require("header.html");
        ?>
    </header>
    <div class="sidebar">
        <h2>Actions</h2>
        <ul>
            <li><a href="register_html.php">Sign Up</a></li>
            <li><a href="login_html.php">Login</a></li>
        </ul>
        <h3>Come see us today!</h3>
        <h5>Phone: 501-555-5555</h5>
        <h5>Email: Ggames@gmail.com</h5>
        <img src="images_folder/five-stars-rating-with-transparent-background-free-png.jpg" alt= "Stars" width="175" height="175">
    </div>
    <div class="main-content">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Welcome</title>
        </head>
        <h1>Welcome to Garner's Games!</h1>
        <br>
        <br>
        <p class="intro-text">Explore our wide selection of games. Sign up now to start your adventure!</p>
        <img src="images_folder/lorenzo-herrera-p0j-mE6mGo4-unsplash.jpg" alt="Games" width="550" height="400">
        <br>
        <h2>Check out our games of the month!</h2>
        <div class="games-of-month">
            <div class="game-image">
                <img src="images_folder/alexey-lastochkin-wvrw5eeo8yg.jpg" alt="Game 1" width="150" height="200">
            </div>
            <div class="game-image">
                <img src="images_folder/The_Elder_Scrolls_V_Skyrim_cover.jpg" alt="Game 2" width="150" height="200">
            </div>
            <div class="game-image">
                <img src="images_folder/eQDrGAx61Azyz9TARuuDVNrQavH3TSru-EvPZjTbTmU.jpg" alt="Game 3" width="150" height="200">
            </div>
            <div class="game-image">
                <img src="images_folder/Mortal_Kombat_X_Cover_Art.jpg" alt="Game 3" width="150" height="200">
            </div>
            <div class="game-image">
                <img src="images_folder/download.jpg" alt="Game 3" width="150" height="200">
            </div>
        </div>


    </div>
        </html>
    <footer>
        <?php
        require("footer.html");
        ?>
    </footer>
</body>
</html>


