<?php
require "db_conn.php";
session_start();
if (isset($_SESSION['username'])) {
    if ((db_connection("SELECT utente.is_admin FROM utente WHERE utente.Nome = '" . $_SESSION['username'] . "'"))->fetch_assoc()['is_admin'] == 1) {
        $_SESSION['is_admin'] = true;
    }
    else{
        $_SESSION['is_admin'] = false;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online - Homepage</title>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/fonseca">
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
    <br>
    <div class="page">
        <h2>Featured Books</h2>
        <div class="book-scroll dragscroll">
            <?php
            $featured_books = db_connection("SELECT * FROM libri ORDER BY RAND() LIMIT 8");
            foreach ($featured_books as $book) {
                if (isset($_SESSION['username'])) {
                    echo '
                    <div class="card">
                        <div class="card2">
                            <div class="book">
                                <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                        </div>
                    </div>
                ';
                } else {
                    echo '
                    <div class="card">
                        <div class="card2">
                            <div class="book">
                                <img onclick="location.href=\'login.php\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                            </div>
                        </div>
                    </div>
                ';
                }
            }
            ?>
        </div>

        <h2>New Arrivals</h2>
        <?php
        $new_arrivals = db_connection("SELECT * FROM libri ORDER BY Data_Pubblicazione DESC LIMIT 8");
        foreach ($new_arrivals as $book) {
            if (isset($_SESSION['username'])) {
                echo '
                <div class="card">
                    <div class="card2">
                        <div class="book">
                            <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                        </div>
                    </div>
                </div>
            ';
            } else {
                echo '
                <div class="card">
                    <div class="card2">
                        <div class="book">
                            <img onclick="location.href=\'login.php\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                        </div>
                    </div>
                </div>
            ';
            }
        }
        ?>
    </div>

</body>

</html>