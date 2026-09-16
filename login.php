<?php

session_start();

require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    exit();
}

$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
    die("Please enter username and password.");
}


$stmt = $conn->prepare(
    "SELECT id, firstname, lastname, username, password, role
     FROM users
     WHERE username = ?"
);

if (!$stmt) {
    die("Database error: " . $conn->error);
}

$stmt->bind_param("s", $username);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();


    if (password_verify($password, $user["password"])) {


        $_SESSION["user_id"] = $user["id"];
        $_SESSION["firstname"] = $user["firstname"];
        $_SESSION["lastname"] = $user["lastname"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];


        if ($user["role"] === "admin") {

            header("Location: ../Dashboard/AdminDashboard.php");
            exit();

        } elseif ($user["role"] === "staff") {

            header("Location: ../Staff/Staff-Dashboard.php");
            exit();

        } elseif ($user["role"] === "student") {

            header("Location: ../Student/Student-Dashboard.php");
            exit();

        } else {

            die("Invalid user role: " . htmlspecialchars($user["role"]));

        }

    } else {

        die("Incorrect password.");

    }

} else {

    die("Username not found.");

}

$stmt->close();
$conn->close();

?>