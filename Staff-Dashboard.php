<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../Login/login.html");
    exit;
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "staff") {
    header("Location: ../Dashboard/AdminDashboard.php");
    exit;
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Dashboard</title>

    <link rel="stylesheet" href="Staff.css">

</head>

<body>

    <div class="sidebar">

        <h2>Staff</h2>

        <a href="Staff-Dashboard.php">Dashboard</a>

        <a href="Students.php">Students</a>

        <a href="../Login/logout.php">Logout</a>

    </div>

    <div class="content">
    </div>

</body>

</html>
