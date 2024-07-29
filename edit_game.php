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
            <li><a href="adminpage.php">Back</a></li>
            <li><a href="index.php">Logout</a></li>
            <li><a href="new_game.php">Add New Game</a></li>
        </ul>

    </div>
    <div class="main-content">

        <?php
        // Include the database connection settings
        include "dbconnect.php";

        // Handle form submission to edit game
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $game_id = $_POST['idGames'];
            $title = $_POST['title'];
            $producer = $_POST['producer'];
            $price = $_POST['price'];

            // SQL query to update game information
            $query = "UPDATE games SET Title = '$title', Producer = '$producer', Price = '$price' WHERE idGames = $game_id";

            // Execute the SQL query
            if (mysqli_query($conn, $query)) {
                echo "<i>Game updated successfully!</i>";
            } else {
                echo "Error updating game: " . mysqli_error($conn);
            }
        }

        // Fetch the list of games from the database
        $query = "SELECT * FROM games ORDER BY Title";
        $result = mysqli_query($conn, $query);

        // Initialize variables to store game data
        $gameTitle = "";
        $gameProducer = "";
        $gamePrice = "";
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Game Information</title>
            <script>
                // JavaScript function to update game information in the form
                function updateGameInfo() {
                    var selectElement = document.getElementById('idGames');
                    var selectedOption = selectElement.options[selectElement.selectedIndex];

                    var title = selectedOption.getAttribute('data-title');
                    var producer = selectedOption.getAttribute('data-producer');
                    var price = selectedOption.getAttribute('data-price');

                    document.getElementById('title').value = title;
                    document.getElementById('producer').value = producer;
                    document.getElementById('price').value = price;
                }
            </script>
        </head>
        <body>
        <h1>Edit Game</h1>

        <form method="post">
            <label for="idGames">Select a Game to Edit:</label>
            <select name="idGames" id="idGames" onchange="updateGameInfo()">
                <?php
                // Loop through game data and populate the select dropdown
                $row = mysqli_fetch_assoc($result);
                $row1 = $row;
                while ($row = mysqli_fetch_assoc($result)) {
                    $gameId = $row['idGames'];
                    $gameTitle = $row['Title'];
                    $gameProducer = $row['Producer'];
                    $gamePrice = $row['Price'];

                    echo "<option value='$gameId' data-title='$gameTitle' data-producer='$gameProducer' data-price='$gamePrice'>$gameTitle</option>";
                }
                ?>
            </select>
            <br><br>

            <h2>Game Information:</h2>
            <?php
            // Initialize game information with the first game's data
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                $gameId = $row1['idGames'];
                $gameTitle = $row1['Title'];
                $gameProducer = $row1['Producer'];
                $gamePrice = $row1['Price'];
            }
            ?>

            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $gameTitle; ?>">
            <br><br>

            <label for="producer">Producer:</label>
            <input type="text" name="producer" id="producer" value="<?php echo $gameProducer; ?>">
            <br><br>

            <label for="price">Price:</label>
            <input type="text" name="price" id="price" value="<?php echo $gamePrice; ?>">
            <br><br>

            <input type="submit" value="Update Game">
        </form>
        </body>
        </html>

        <?php
        // Close the database connection
        mysqli_close($conn);
        ?>

