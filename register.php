<?php
// Include the configuration file to access database credentials
require_once("config.php");

// Create a new MySQLi database connection using credentials from the config file
$conn = new mysqli(db_host, db_user, db_pass, db_name);

// Check if the database connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the HTTP request method is POST (form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the POST data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Hash the password using the default password hashing algorithm
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Set the default admin value (assumed to be 0)
    $defaultAdmin = 0;

    // SQL query to insert a new user into the 'users' table
    $sql = "INSERT INTO users (username, password, admin) VALUES (?,?,?)";

    // Prepare the SQL statement for execution
    $stmt = $conn->prepare($sql);

    // Check if the statement preparation was successful
    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    // Bind parameters to the prepared statement (username, hashed password, default admin value)
    $stmt->bind_param("ssi", $username, $hashPassword, $defaultAdmin);

    // Execute the prepared statement (insert the new user into the database)
    if ($stmt->execute()) {
        // Display a success message
        echo "Successful";

        // Redirect the user to the 'welcome.php' page
        header("Location: welcome.php");
        exit();
    } else {
        // Display a failure message if the insertion fails
        echo "Failed";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
