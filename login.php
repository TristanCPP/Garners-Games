<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

        require_once("config.php");

        $conn = new mysqli(db_host, db_user, db_pass, db_name);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST["username"];
            $password = $_POST["password"];
        }

        $sql = "SELECT username, password, admin FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $encryptedPassword = $row['password'];
            if(password_verify($password, $encryptedPassword))
            {
                $_SESSION["username"] = $username;
                $_SESSION["loggedin"] = true;
                if($row['admin'] == 1){
                    $_SESSION["admin"] = 1;
                }
                else{
                    $_SESSION["admin"] = 0;
                }
                header("Location: welcome.php");
                exit();

            }
            else
            {
                $_SESSION["loggedin"] = false;
                echo "Invalid username or password";
                header("Location:login_html.php");
                exit();
            }
        }
        ?>

