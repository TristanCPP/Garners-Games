<?php
//define("db_host", "localhost");
//define("db_user", "root");
//define("db_pass", "");
//define("db_name", "testdb");

define("db_host", "npcwp.com");
define("db_user", "npcwpcom_tristan");
define("db_pass", "npcwp4018%");
define("db_name", "npcwpcom_tristanDB");

$conn = new mysqli(db_host, db_user, db_pass, db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
