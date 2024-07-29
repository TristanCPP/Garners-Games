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
            background-color: #0e2d3f;
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
            background-color: #1e1f22; /* Button color */
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
            gap: 0px; /* This will add space between your images */
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
            flex: 7;
            padding: 20px;
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
        <h2>Sidebar</h2>
        <ul>
            <!-- Navigation links -->
            <li><a href="adminpage.php">Back</a></li>
            <li><a href="index.php">Logout</a></li>
            <li><a href="edit_game.php">Edit Games</a></li>
        </ul>
    </div>
    <div class="main-content">
        <html>
        <head>
            <title>Games</title>
        </head>
        <body>
        <?php
        // Check if the request method is not POST
        if ($_SERVER["REQUEST_METHOD"] != "POST") {
            ?>
            <!-- Display a form to add a new game -->
            <form method="post" action="new_game.php">
                <h2>Add New Game</h2>
                <br>
                <label for="title">Title:</label>
                <input type="text" name="title" required><br><br>

                <label for="price">Price:</label>
                <input type="number" name="price" required><br><br>

                <label for="year">Year</label>
                <input type="number" name="year" required><br><br>

                <label for="rating">Rating:</label>
                <input type="text" name="rating" required><br><br>

                <label for="producer">Producer:</label>
                <input type="text" name="producer" required><br><br>

                </select>
                <input type="submit" name="submit" value="Add Game">
            </form>
            <?php
        } else {
            // Retrieve game data from the POST request and call the 'insertGame' function
            $title = $_POST["title"];
            $price = $_POST["price"];
            $year = $_POST["year"];
            $rating = $_POST["rating"];
            $producer = $_POST["producer"];

            insertGame($title, $price, $year, $rating, $producer);
        }
        ?>
        </body>
        </html>

        <?php
        // Define a function to insert a new game into the database
        function insertGame($_title, $_price, $_year, $_rating, $_producer)
        {
            require_once("config.php");

            // Create a new MySQLi database connection using credentials from the config file
            $conn = new mysqli(db_host, db_user, db_pass, db_name);

            // Check if the database connection was successful
            if ($conn->connect_error)
                die("Connection Failed");

            // SQL query to insert a new game into the 'games' table
            $sql = "INSERT INTO games (Title, Price, Year, Rating, Producer) VALUES (?,?,?,?,?)";

            // Prepare the SQL statement for execution
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiss", $_title, $_price, $_year, $_rating, $_producer);

            // Execute the prepared statement (insert the new game into the database)
            if ($stmt->execute()) {
                echo "Game added successfully";
            } else {
                echo "Error" . $stmt->error;
            }

            // Close the prepared statement and the database connection
            $stmt->close();
            $conn->close();
        }
        ?>

    </div>
    <footer>
        <?php
        require("footer.html");
        ?>
    </footer>
</div>
</body>
</html>
