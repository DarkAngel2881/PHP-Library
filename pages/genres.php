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
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro +</button>
            <?php
            if (isset($_SESSION['username'])) {
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'profile.php\';">Profilo</button>';
            } else {
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'login.php\';">Login/Sign Up</button>';
            }
            ?>
        </div>
    </header>
</head>

<body>

    <br>
    <div class="page">
        <?php
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
        }
        $genre = db_connection("SELECT DISTINCT Genere FROM libri WHERE genere IS NOT NULL");
        foreach ($genre as $row) {
            $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = '" . $row['Genere'] . "'");
            echo "<h2>" . $row['Genere'] . "</h2>";
            echo '<div class="book-scroll dragscroll">';


            $i = 0;
            foreach ($bookrow as $libro) {
                if ($i <= 7) {
                    $i++;
                    echo '
                            <div class="card">
                                <div class="card2">
                                    <div class="book">
                                        <img onclick="location.href=\'book.php?id=' . $libro['ID_Libro'] . '\'" src="/uploads/' . $libro['Copertina'] . '" alt="Book cover" class="book-cover">
                                    </div>
                                </div>
                            </div>
                        ';
                }
            }
            $bookrow->close();
            echo '</div><br><br>';
        }
        ?>

    </div>

</body>

</html>