<?php
// db_connect.php
$servername = "localhost";
$db_username = "root";
$db_password = "";   // XAMPP default has empty password for root
$dbname = "admin_panel";

// Create connection
$db = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Database connection failed: " . $db->connect_error);
}
$db->set_charset("utf8");  // ensure proper encoding
?>