<?php
// Include the database connection file
require "db_conn.php";

// Start the session if the user is logged in
session_start();

?>

<!-- HTML document starts here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="/css/test-style.css">
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="/css/searchbar.css">
    <style>
        /* Styling for the book details */
        .book {
            margin-left: 0;
        }

        /* Styling for headings */
        h2 {
            font-family: 'Fonseca', sans-serif;
            color: white;
            font-size: 1.7em;
            margin: 0;
            margin-left: 1px;
            margin-bottom: 10px;
            width: fit-content;
        }

        /* Styling for headings */
        h3 {
            font-family: 'Fonseca', sans-serif;
            font-size: 1em;
            color: white;
            margin: 0;
            width: fit-content;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to external font stylesheet -->
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <title>Document</title>

    <!-- Header section starts here -->
    <header>
        <div class="container">
            <h2>Biblioteca Online</h2>
        </div>
        <div class="navbar">
            <!-- Button to navigate to home page -->
            <button class="btn btn-success btn-hover" onclick="location.href='home.php';">Home</button>
            <!-- Search form -->
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="What do you want to read..." />
                <button type="reset"></button>
            </form>
            <!-- Button to navigate to genres page -->
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
            <?php
            // Check if the user is logged in and display appropriate buttons
            if (isset($_SESSION['username'])) {
                if ($_SESSION['is_admin']) {
                    // Display button to add a new book (only for admins)
                    echo '<button class="btn btn-success btn-hover" onclick="location.href=\'new_book.php\';">Libro +</button>';
                }
                // Display button to navigate to profile page
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'profile.php\';">Profilo</button>';
            } else {
                // Display button to navigate to login/signup page
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'login.php\';">Login/Sign Up</button>';
            }
            ?>
        </div>
    </header>

    <!-- Body section starts here -->

<body>
    <div id="background"></div>
    <div class="page">
        <?php
        // Get the book ID from the URL parameter
        $bookId = $_GET['id'];

        // Query the database to retrieve the book details
        $book = db_connection("SELECT libri.*
            FROM libri
            JOIN generi ON libri.Genere = generi.Nome
            WHERE libri.ID_Libro = $bookId;")->fetch_assoc();

        // Display the book details
        ?>
        <div class="book-details">
            <div class="book">
                <?php echo '<img src="/uploads/' . $book["Copertina"] . '" alt="Book cover" class="book-cover">'; ?>
            </div>
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
        <!-- Display the book description -->
        <h3>Descrizione</h3>
        <p style="max-width: 65%;"><?php echo $book['Trama']; ?></p>

        <?php
        // Check if the book is taken
        if ($book['is_taken']) {
            $username = $_SESSION['username'];
            $id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];
            $taken_by_user = db_connection("SELECT * FROM prestiti WHERE ID_Libro = $bookId AND ID_Utente = $id_user")->fetch_assoc();
            if ($taken_by_user) {
                // Display a message if the user has taken the book
                echo '<h3 style="color:red">Hai preso questo libro! </h3> <br><form action="return_book.php" method="post"><input type="hidden" name="book_id" value="' . $bookId . '"><button class="button1" type="submit" class="btn btn-success btn-hover">Restituisci il libro</button></form>';
            } else {
                // Display a message if the book is not available
                echo '<h3 style="color:red">NON DISPONIBILE</h3>';
            }
        } else {
            // Display a message if the book is available
            echo '<h3 style="color:green">DISPONIBILE</h3>';
        }
        ?>
        <br>
        <?php
        // Check if the book is not taken and display a form to take the book
        if (!$book['is_taken']) { ?>
            <form action="update_book_status.php" method="post">
                <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
                <button class="button1" type="submit" class="btn btn-success btn-hover">Prendi il libro</button>
            </form>
        <?php } ?>


    </div>
</body>

</html>