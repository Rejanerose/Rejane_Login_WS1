<?php

$host = "sql201.infinityfree.com";
$username = "if0_42933051";
$password = "Rejanerose27";
$database = "if0_42933051_login";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
