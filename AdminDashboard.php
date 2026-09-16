<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../Login/login.html");
    exit();
}

if ($_SESSION["role"] !== "admin") {
    header("Location: ../Staff/Staff-Dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin.css">

</head>

<body>

    <div class="sidebar">
        <h2>Admin</h2>

        <a href="AdminDashboard.php">Home</a>
        <a href="AdminDashboard.php">Dashboard</a>
        <a href="../Login/logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Admin Dashboard</h1>
    </div>

</body>

</html>
