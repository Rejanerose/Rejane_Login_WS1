<?php

require_once "../database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: register.html");
    exit();
}

$firstname = trim($_POST["firstname"] ?? "");
$lastname = trim($_POST["lastname"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$confirmPassword = $_POST["confirmPassword"] ?? "";

if (
    $firstname === "" ||
    $lastname === "" ||
    $username === "" ||
    $password === "" ||
    $confirmPassword === ""
) {
    die("Please fill in all fields.");
}

if ($password !== $confirmPassword) {
    die("Passwords do not match.");
}

$check = $conn->prepare(
    "SELECT id FROM users WHERE username = ?"
);

if (!$check) {
    die("Database error: " . $conn->error);
}

$check->bind_param("s", $username);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {
    die("Username already exists. Please choose another username.");
}

$check->close();

$hashedPassword = password_hash(
    $password,
    PASSWORD_DEFAULT
);

$role = "student";

$stmt = $conn->prepare(
    "INSERT INTO users
    (firstname, lastname, username, password, role)
    VALUES (?, ?, ?, ?, ?)"
);

if (!$stmt) {
    die("Insert error: " . $conn->error);
}

$stmt->bind_param(
    "sssss",
    $firstname,
    $lastname,
    $username,
    $hashedPassword,
    $role
);

if ($stmt->execute()) {

    header("Location: ../Login/index.html");
    exit();

} else {

    die("FAILED TO CREATE ACCOUNT: " . $stmt->error);

}

$stmt->close();
$conn->close();

?>
