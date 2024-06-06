<?php
// Include the database connection file
require 'db_conn.php';

// HTML document starts
?><!DOCTYPE html>
<html lang="en">

<head>
    <!-- JavaScript code to redirect to home.php after 5 seconds -->
    <script>
        setTimeout(function() {
            window.location.href = 'home.php';
        }, 5000);
    </script>

    <!-- CSS styles for the page -->
    <style>
        .page {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <!-- Meta tags and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>

    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="/css/test-style.css">

    <!-- Link to external font -->
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
</head>

<body>
    <div class="page">
        <div id="background"></div>

        <?php
        // Define the upload directory
        define('UPLOAD_DIR', 'C:/Users/matte/Documents/Scuola/Informatica/PHP-Library/uploads/');

        // Check if the image file is uploaded
        if (isset($_FILES['immagine'])) {
            $file = $_FILES['immagine'];
            $bookCoverName = $file['name'];

            // Check if the file is uploaded successfully
            if ($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])) {
                // Define the file path and move the uploaded file to the upload directory
                $percorso = UPLOAD_DIR . $file['name'];
                move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $file['name']);
            }
        }

        // Get the book details from the POST request
        $bookTitle = $_POST['book-title'];
        $bookAuthor = $_POST['book-author'];
        $bookPublisher = $_POST['book-publisher'];
        $bookYear = $_POST['book-year'] . "/01/01";
        $bookGenre = $_POST['book-genre'];
        $trama = $_POST['trama'];
        $pages = $_POST['book-pages'];

        // Create the SQL query to insert the book details into the database
        $sql = "INSERT INTO libri (Copertina, Titolo, Autore, Data_Pubblicazione, Genere, Trama, Numero_Pagine, Casa_Editrice)
VALUES ('$bookCoverName', '$bookTitle', '$bookAuthor', '$bookYear', '$bookGenre', '$trama', '$pages', '$bookPublisher')";

        // Execute the SQL query using the db_connection function
        $res = db_connection($sql);

        // Check if the query was executed successfully
        if ($res === TRUE) {
            echo "<h2>New book added successfully</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . $res;
        }

        // Display a message indicating that the page will redirect
        echo "<h3>Redirecting...</h3>";
        ?>

    </div>

</body>

</html>