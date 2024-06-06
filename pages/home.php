<?php
// Include the database connection file
require "db_conn.php";

// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    // Check if the user is an admin
    if ((db_connection("SELECT utente.is_admin FROM utente WHERE utente.Nome = '" . $_SESSION['username'] . "'"))->fetch_assoc()['is_admin'] == 1) {
        // Set the is_admin session variable to true
        $_SESSION['is_admin'] = true;
    } else {
        // Set the is_admin session variable to false
        $_SESSION['is_admin'] = false;
    }
}
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
    <title>Biblioteca Online - Homepage</title>

    <!-- Link to external CSS files -->
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
</head>

<body>
    <!-- Background element -->
    <div id="background"></div>

    <!-- Header section -->
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

            <!-- Conditional statement to display either the new book button or the login/signup button -->
            <?php
            if (isset($_SESSION['username'])) {
                if ($_SESSION['is_admin']) {
                    echo '<button class="btn btn-success btn-hover" onclick="location.href=\'new_book.php\';">Libro +</button>';
                }
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'profile.php\';">Profilo</button>';
            } else {
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'login.php\';">Login/Sign Up</button>';
            }
            ?>
        </div>
    </header>

    <!-- Page content -->
    <div class="page">
        <h2>Featured Books</h2>
        <div class="book-scroll dragscroll">
            <?php
            // Query to retrieve 8 random books from the database
            $featured_books = db_connection("SELECT * FROM libri ORDER BY RAND() LIMIT 8");

            // Loop through the featured books
            foreach ($featured_books as $book) {
                if (isset($_SESSION['username'])) {
                    // Display the book cover with a link to the book details page
                    echo '
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
                } else {
                    // Display the book cover with a link to the login page
                    echo '
                            <div class="book">
                                <img onclick="location.href=\'login.php\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
                }
            }
            ?>
        </div>

        <h2>New Arrivals</h2>
        <div class="book-scroll dragscroll">
            <?php
            // Query to retrieve 8 new arrivals from the database
            $new_arrivals = db_connection("SELECT * FROM libri ORDER BY Data_Pubblicazione DESC LIMIT 8");

            // Loop through the new arrivals
            foreach ($new_arrivals as $book) {
                if (isset($_SESSION['username'])) {                // Display the book cover with a link to the book details page
                    echo '
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
                } else {
                    // Display the book cover with a link to the login page
                    echo '
                            <div class="book">
                                <img onclick="location.href=\'login.php\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
                }
            }
            ?>
        </div>
</body>

</html>