<?php
require "db_conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <style>
        .book {
            margin-left: 0;
        }

        h2 {
            font-family: 'Fonseca', sans-serif;
            color: white;
            font-size: 1.7em;
            margin: 0;
            margin-left: 1px;
            margin-bottom: 10px;
            width: fit-content;
        }

        h3 {
            font-family: 'Fonseca', sans-serif;
            color: white;
            font-size: 1em;
            margin: 0;
            width: fit-content;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <title>Document</title>

    <header>
        <div class="container">
            <h2>Biblioteca Online</h2>
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
</head>

<body>
    <div id="background"></div>
    <div class="page">
        <?php
        $bookId = $_GET['id'];

        $book = db_connection("SELECT libri.*
        FROM libri
        JOIN generi ON libri.Genere = generi.Nome
        WHERE libri.ID_Libro = $bookId;")->fetch_assoc();
        ?>

        <div class="book-details">
            <div class="book"><?php echo '<img src="/uploads/' . $book["Copertina"] . '" alt="Book cover" class="book-cover">'; ?></div>
            <div class="book-info">
                <h2><?php echo $book['Titolo']; ?></h2>
                <strong><?php echo $book['Autore'] ?></strong><br><br>
                <?php echo "<strong>" . $book['Numero_Pagine'] . "</strong> pagine" ?><br><br>
                <?php echo "<strong>" . $book['Casa_Editrice'] . "</strong>" ?><br><br>
                <?php echo "<strong>" . date('Y', strtotime($book['Data_Pubblicazione'])) . "</strong> (anno edizione)" ?><br><br>
                <?php echo "<strong> " . $book['Genere'] . "</strong>" ?>

            </div>
        </div>
        <br><br>

        <h3>Descrizione</h3>
        <p style="max-width: 65%;"><?php echo $book['Trama']; ?></p>
    </div>
</body>

</html>