<?php

$host = "sql207.infinityfree.com";
$user = "if0_42936387";
$password = "Rejane2006";
$database = "if0_42936387_portfolio";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
