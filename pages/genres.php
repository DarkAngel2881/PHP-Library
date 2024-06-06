<?php
// Include the database connection file
require "db_conn.php";

// Start the session
session_start();
?>

<!-- HTML document starts -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Script to enable drag scrolling on elements with class "book-scroll" -->
    <script src="/scripts/dragscroll.js">
        document.addEventListener('DOMContentLoaded', function() {
            var bookScroll = document.querySelector('.book-scroll');
            new dragscroll(bookScroll);
        });
    </script>

    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>

    <!-- Link to external CSS files -->
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
</head>

<header>
    <!-- Container for the header content -->
    <div class="container">
        <h1>Biblioteca Online</h1>
    </div>

    <!-- Navigation bar -->
    <div class="navbar">
        <!-- Button to navigate to home.php -->
        <button class="btn btn-success btn-hover" onclick="location.href='home.php';">Home</button>

        <!-- Search form -->
        <form class="search-box" action="search.php">
            <input type="text" name="query" placeholder="What do you want to read..." />
            <button type="reset"></button>
        </form>

        <!-- Button to navigate to genres.php -->
        <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>

        <!-- Button to navigate to new_book.php -->
        <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro +</button>

        <!-- Conditional statement to display either the profile button or the login/signup button -->
        <?php
        if (isset($_SESSION['username'])) {
            echo '<button class="btn btn-success btn-hover" onclick="location.href=\'profile.php\';">Profilo</button>';
        } else {
            echo '<button class="btn btn-success btn-hover" onclick="location.href=\'login.php\';">Login/Sign Up</button>';
        }
        ?>
    </div>
</header>

<body>
    <!-- Background element -->
    <div id="background"></div>

    <!-- Page content -->
    <div class="page">
        <?php
        // Check if the username is set in the GET request
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
        }

        // Query to retrieve distinct genres from the database
        $genre = db_connection("SELECT DISTINCT Genere FROM libri WHERE genere IS NOT NULL");

        // Loop through the genres and display books for each genre
        foreach ($genre as $row) {
            $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = '" . $row['Genere'] . "'");

            // Display the genre title
            echo "<h2>" . $row['Genere'] . "</h2>";

            // Create a div for the book scroll
            echo '<div class="book-scroll dragscroll">';

            // Initialize a counter for the number of books displayed
            $i = 0;

            // Loop through the books for the current genre
            foreach ($bookrow as $libro) {
                // Check if the counter is less than or equal to 7
                if ($i <= 7) {
                    $i++;

                    // Display the book cover with a link to the book details page
                    echo '
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $libro['ID_Libro'] . '\'" src="/uploads/' . $libro['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                    ';
                }
            }

            // Close the book scroll div
            echo '</div><br><br>';
        }
        ?>
    </div>
</body>

</html>