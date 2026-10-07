<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../Login/index.html");
    exit();
}

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "student") {
    header("Location: ../Login/login.html");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <link rel="stylesheet" href="Student.css">

</head>

<body>

    <div class="sidebar">

        <h2>Student</h2>

        <a href="Student-Dashboard.php">
            Dashboard
        </a>

        <a href="My-Profile.php">
            My Profile
        </a>

        <a href="My-Fee.php">
            My Fee
        </a>

        <a href="My-Payment.php">
            My Payments
        </a>

        <a href="My-Balance.php">
             My Balance
        </a>

        <a href="../Login/logout.php">
            Logout
        </a>

    </div>

    <div class="main">

        <div class="welcome">

            <h1>
                Welcome, <?php echo htmlspecialchars($_SESSION["firstname"]); ?>!
            </h1>

            <p>
                Welcome  Student .
            </p>    

        </div>


        <div class="cards">

            <div class="card">

                <h3>My Profile</h3>

                <p>
                    View  personal information.
                </p>

            </div>


            <div class="card">

                <h3>My Fee</h3>

                <p>
                    View  Fee.
                </p>

            </div>

            <div class="card">

            <h3> My Payment</h3>

            <p>
            View Payment.
            </p>
            
            </div> 


            <div class="card">

                <h3>My Remaing Balance</h3>

                <p>
                    View Balance.
                </p>

            </div>

        </div>

    </div>

</body>

</html>
