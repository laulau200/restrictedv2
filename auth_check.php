<?php
// auth_check.php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');   // bounce guests to the login page
    exit();
}
?>