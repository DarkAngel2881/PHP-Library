<?php
require "db_conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/scripts/dragscroll.js">
        document.addEventListener('DOMContentLoaded', function() {
            var bookScroll = document.querySelector('.book-scroll');
            new dragscroll(bookScroll);
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
    <style>
        h3 {
            text-align: left;
        }
    </style>
</head>

<body>
    <div id="background"></div>
    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>

        <div class="navbar">
            <button class="btn btn-success btn-hover" onclick="location.href='home.php';">Home</button>
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="What do you want to read..." />
                <button type="reset"></button>
            </form>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
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
    <?php
    $username = $_SESSION['username'];
    ?>
    <div class="page">

        <h3>Username:<?php echo ' ' . $username; ?></h3>


        <h3>My Books</h3>
        <div class="book-scroll dragscroll" style="margin-left:2em">
            <?php
            $username = $_SESSION['username'];
            $id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];
            $books = db_connection("SELECT * FROM libri l JOIN prestiti p ON l.ID_Libro = p.ID_Libro WHERE p.ID_Utente = $id_user");
            foreach ($books as $book) {
                echo '
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                ';
            }
            ?>
        </div>




        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>


    </div>


</body>

</html>