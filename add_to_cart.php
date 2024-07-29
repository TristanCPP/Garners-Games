<?php
        session_start();
        require_once("dbconnect.php");

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
            $games_ID = $_GET["id"];

            // Fetch game information from the database
            $query = "SELECT Title, Producer, Price FROM games WHERE idGames = $games_ID";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $game = $result->fetch_assoc();

                // Check if the cart exists in the session, if not, create it
                if (!isset($_SESSION["cart"])) {
                    $_SESSION["cart"] = [];
                }

                // Add the selected game to the cart
                $_SESSION["cart"][] = $game;

            }

            header("Location: searchForm.php"); // Redirect back to the search page
        }
        ?>

