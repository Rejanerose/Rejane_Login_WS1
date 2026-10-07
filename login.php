<?php

session_start();

require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: Login/login.html");
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

if (!$stmt->execute()) {
    die("Login error: " . $stmt->error);
}

$stmt->store_result();

if ($stmt->num_rows === 1) {

    $stmt->bind_result(
        $id,
        $firstname,
        $lastname,
        $db_username,
        $db_password,
        $role
    );

    $stmt->fetch();

    if (password_verify($password, $db_password)) {

        $_SESSION["user_id"] = $id;
        $_SESSION["firstname"] = $firstname;
        $_SESSION["lastname"] = $lastname;
        $_SESSION["username"] = $db_username;
        $_SESSION["role"] = $role;

        if ($role === "admin") {

            header("Location: AdminDashboard.php");
            exit();

        } elseif ($role === "staff") {

            header("Location: Staff-Dashboard.php");
            exit();

        } elseif ($role === "student") {

            header("Location: Student-Dashboard.php");
            exit();

        } else {

            die("Invalid user role: " . htmlspecialchars($role));
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
