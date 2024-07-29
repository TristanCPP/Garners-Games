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
        <h2>Sidebar</h2>
        <ul>
            <li><a href="welcome.php">Home</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
        <h3>Come see us today!</h3>
        <h5>Phone: 501-555-5555</h5>
        <h5>Email: Ggames@gmail.com</h5>
        <img src="images_folder/five-stars-rating-with-transparent-background-free-png.jpg" alt= "Stars" width="175" height="175">
    </div>
    <div class="main-content">
        <h1>Shopping Cart</h1>
        <?php
        // Start a session (if not already started)
        // session_start();

        // Initialize the total cost to zero
        $total = 0;

        // Check if the 'cart' session variable is set and not empty
        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
            // Display a table to list items in the shopping cart
            echo("<table border='1' cellpadding='10px'><tr><td>Title</td><td>Producer</td><td>Price</td></tr>");

            // Loop through items in the shopping cart
            for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
                $game = $_SESSION["cart"][$i];

                // Display item details in a table row
                echo "<tr><td>" . $game["Title"] . "</td><td>" . $game["Producer"] . "</td><td>$" . $game["Price"] . "</td><td><a href='remove_from_cart.php?id=$i'>Delete Item</a></td></tr>";

                // Update the total cost
                $total = $total + $game["Price"];
            }

            echo("</table");
        } else {
            // Display a message if the shopping cart is empty
            echo "Your shopping cart is empty.";
        }
        ?>
        <br>
        <br>
        <?php
        // Display the total cost
        echo("Total: $" . $total);
        ?>
        <br>
        <br>
        <br>
        <button id="Return">Back To Search</button>
        <script type="text/javascript">
            // Add an event listener to the "Return" button to navigate back to the search page
            document.getElementById('Return').addEventListener('click', function () {
                window.location.href = 'searchForm.php';
            });
        </script>
    </div>
    <footer>
        <?php
        require("footer.html");
        ?>
    </footer>
</div>
</body>
</html>


