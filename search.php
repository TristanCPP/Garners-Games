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

        /* Zebra striping for table rows */
        table tr:nth-child(odd) {
            background-color: #1e1f22;
        }

        table tr:nth-child(even) {
            background-color: rgb(40, 40, 42);
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
            padding-right: 100px;
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
        // Include the 'header.html' file in this section
        require("header.html");
        ?>
    </header>
    <div class="sidebar">
        <h2>Action</h2>
        <ul>
            <!-- Create navigation links -->
            <li><a href="searchForm.php">Back</a></li>
            <li><a href="welcome.php">Home</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <?php
        // Including 'dbconnect.php' file to establish a database connection
        require_once("dbconnect.php");

        // Check if the request method is POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check the value of the 'action' key in the POST data
            if ($_POST['action'] == "Price") {
                // Get upper and lower price values from POST data
                $upper = $_POST['upper'];
                $lower = $_POST['lower'];
                // Create a SQL query to select games within the specified price range
                $query = "SELECT * FROM games WHERE Price BETWEEN '$lower' AND '$upper' ORDER BY Price ASC";
            }

            // Check if the action is "Title"
            if ($_POST['action'] == "Title") {
                // Get the search keyword from POST data
                $search = $_POST["search"];
                // Create a SQL query to select games with titles matching the search keyword
                $query = "SELECT * FROM games WHERE Title LIKE '%$search%' ORDER BY Title ASC";
            }

            // Check if the action is "Producer"
            if ($_POST['action'] == "Producer") {
                // Get the search keyword from POST data
                $search = $_POST["search"];
                // Create a SQL query to select games with producers matching the search keyword
                $query = "SELECT * FROM games WHERE Producer LIKE '%$search%' ORDER BY Producer ASC";
            }

            // Execute the SQL query
            $result = $conn->query($query);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Display a table with game information
                echo ("<table border='1'><tr><td>Title</td><td>Producer</td><td>Price</td></tr>");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["Title"] . "</td><td>" . $row["Producer"] . "</td><td>" . $row["Price"] . "</td><td> <a href='add_to_cart.php?id=" . $row["idGames"] . "'>Add to Cart</a></td></tr>";
                }
                echo ("</table");
            } else {
                // Display a message if no results were found
                echo "No results found.";
            }
        }
        ?>
    </div>
    <footer>
        <?php
        // Include the 'footer.html' file in this section
        require("footer.html");
        ?>
    </footer>
</div>
</body>
</html>

