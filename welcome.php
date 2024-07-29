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

        .special-text{
            font-family: "Century Gothic", sans-serif;
            color: gold;
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
            padding-right: 200px;
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
            <li><a href="searchForm.php">Shop For Games</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
        <h3>Come see us today!</h3>
        <p>Phone: 501-555-5555</p>
        <p>Email: Ggames@gmail.com</p>
        <img src="images_folder/five-stars-rating-with-transparent-background-free-png.jpg" alt= "Stars" width="175" height="175">
    </div>
    <div class="main-content">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Welcome</title>
        </head>
        <body>
        <?php
        echo 'Welcome ' . $_SESSION["username"] . ',';
        echo '<br>';
        echo 'Please use a link in the Action Bar to navigate.';
        echo '<br>';

        if($_SESSION['admin'] == 1){
            echo '<br> For Admin Functions, please use the link below.';
            echo '<br><a href="adminpage.php">Admin Pages</a>';
        }
        ?>
        <br><br>
        <img src="images_folder/Crossed_swords.svg.jpg" width="200" height="200">
        <br>
        <div class="special-text">
            Get Ready for Adventure!
        </div>
        </body>
        </html>
    </div>
    <footer>
        <?php
        require("footer.html");
        ?>
    </footer>
</div>
</body>
</html>

