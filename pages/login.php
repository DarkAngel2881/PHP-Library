<?php
require "db_conn.php";
// Check if the username is set in the POST request
if (isset($_POST['username'])) {
    // Check if the password is set in the POST request
    if (isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the submit button is set to 'login'
        if (isset($_POST['submit']) && $_POST['submit'] == 'login') {
            // Query to retrieve the user from the database
            $user = db_connection("SELECT * FROM utente WHERE Nome = '$username' and Pwd = '$password';");

            // Check if the user exists
            if (isset($user->fetch_assoc()['Nome'])) {
                // Start the session
                session_start();

                // Set the username session variable
                $_SESSION['username'] = $username;

                // Redirect to home.php
                header('Location: home.php');
                exit();
            } else {
                // Set the login error message
                $_GET['login_error'] = 'Invalid Username or Password';
            }
        } else {
            // Query to check if the username already exists
            $user = db_connection("SELECT * FROM utente WHERE Nome = '$username'");

            // Check if the username does not exist
            if (!isset($user->fetch_assoc()['Nome'])) {
                // Insert the new user into the database
                db_connection("INSERT INTO utente (Nome, Pwd) VALUES ('$username', '$password');");

                // Start the session
                session_start();

                // Set the username session variable
                $_SESSION['username'] = $username;

                // Redirect to home.php
                header('Location: home.php');
                exit();
            } else {
                // Set the login error message
                $_GET['login_error'] = 'Username already exists';
            }
        }
    }
}
?>

<!-- HTML document starts -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="/css/login.css">

    <!-- Style for the body and head elements -->
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

    <!-- Link to home.php -->
    <a id="back-button" href="home.php">Home</a>
</head>

<body>
    <!-- Background element -->
    <div id="background"></div>


    <!-- Login form wrapped in animated box-->
    <div class="card">
        <div class="card2">

            <form class="form" method="POST" action="login.php">

                <p id="heading">Login</p>
                <div class="field">
                    <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                    </svg>
                    <input type="text" name="username" class="input-field" placeholder="Username" autocomplete="off" />
                </div>
                <div class="field">
                    <svg viewBox="0 0 16 16" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="input-icon">
                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                    </svg>
                    <input type="password" name="password" class="input-field" placeholder="Password" />
                </div>
                <div class="btn">
                    <button class="button1" type="submit" name="submit" value="login">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Login&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </button>
                    <button class="button2" type="submit" name="submit" value="signup">Sign Up</button>
                    <br>
                </div>
            </form>
        </div>
    </div>

    <div class="error">
        <?php
        // Display the login error message
        if (isset($_GET['login_error'])) {
            echo "<p style='color:red;'>". $_GET['login_error']. "</p>";
        }
       ?>
    </div>
</body>

</html>