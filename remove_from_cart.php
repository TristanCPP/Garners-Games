<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"]))
{
    $index = $_GET["id"];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    header("Location: shoppingCart.php");
}

?>
