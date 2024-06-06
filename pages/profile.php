<?php
// Include the database connection file
require "db_conn.php";
// Start the session
session_start();
?>

<!-- HTML document starts here -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include the dragscroll JavaScript file -->
    <script src="/scripts/dragscroll.js">
        // Add an event listener to the document to initialize the dragscroll plugin
        document.addEventListener('DOMContentLoaded', function() {
            var bookScroll = document.querySelector('.book-scroll');
            new dragscroll(bookScroll);
        });
    </script>
    <!-- Meta tags and CSS links -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
    <!-- Inline CSS style for h3 elements -->
    <style>
        h3 {
            text-align: left;
        }
    </style>
</head>

<body>
    <!-- Background div -->
    <div id="background"></div>
    <!-- Header section -->
    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>
        
        <!-- Navigation bar -->
        <div class="navbar">
            <!-- Home button -->
            <button class="btn btn-success btn-hover" onclick="location.href='home.php';">Home</button>
            <!-- Search form -->
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="What do you want to read..." />
                <button type="reset"></button>
            </form>
            <!-- Genres button -->
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
            <?php
            // Check if the user is logged in and display appropriate buttons
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
    
    <?php
    // Get the username from the session
    $username = $_SESSION['username'];
    ?>
    
    <!-- Page content -->
    <div class="page">
        <h3>Username:<?php echo ' ' . $username; ?></h3>
        
        <h3>My Books</h3>
        <!-- Book scroll container -->
        <div class="book-scroll dragscroll" style="margin-left:2em">
            <?php
            // Get the user ID from the database
            $id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];
            // Get the user's books from the database
            $books = db_connection("SELECT * FROM libri l JOIN prestiti p ON l.ID_Libro = p.ID_Libro WHERE p.ID_Utente = $id_user");
            // Loop through the books and display them
            foreach ($books as $book) {
                echo '
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
            }
            ?>
        </div>
        
        <!-- Logout form -->
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>