<?php
require "db_conn.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .book{
            margin-left: 0;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <title>Document</title>

    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>
        <div class="navbar">
            <button class="btn btn-primary btn-hover" onclick="location.href='home.php';">Home</button>
            <button class="btn btn-secondary btn-hover" onclick="location.href='search.html';">Cerca</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Tendenza</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro +</button>
        </div>
    </header>
</head>

<body>
    <div class="page">
        <?php
        $bookId = $_GET['id'];

        $book = db_connection("SELECT libri.*, generi.Icon
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
                <?php echo "<div style='font-size: 1.25em; display: inline-block'>" . $book['Icon'] . "</div><strong> " . $book['Genere'] . "</strong>" ?>

            </div>
        </div>
        <br><br>

        <h3>Descrizione</h3>
        <p style="max-width: 65%;"><?php echo $book['Trama']; ?></p>
    </div>
</body>

</html>