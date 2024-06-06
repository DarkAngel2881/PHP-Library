<?php
require "db_conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
    <style>
        body {
            display: flex;
            justify-content: center;
        }

        head {
            display: flex;
            justify-content: left;
        }
    </style>
</head>

<body>
    <div id="background"></div>
    <?php
    $username = $_SESSION['username'];
    ?>
    <div class="card">
        <div class="card2">
            <div class="user_container">
                <h3>Username:<?php echo ' ' . $username; ?></h3>
                <form action="logout.php" method="post">
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>