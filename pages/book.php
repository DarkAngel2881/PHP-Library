<!DOCTYPE html>
<html lang="en">

<head>
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
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Categorie</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Tendenza</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro+</button>
        </div>
    </header>
</head>

<body>
    <div class="page">
        <?php

        function db_connection($sql)
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "libri";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $res = $conn->query($sql);

            foreach ($res as $query) {
                $conn->close();

                return $query;
            }
        }

        $bookId = $_GET['id'];

        $book = db_connection("SELECT * FROM libri WHERE ID_Libro = $bookId");
        ?>

        <div class="book-details">
            <div class="book"><?php echo '<img src="/uploads/'. $book["Copertina"] . '" alt="Book cover" class="book-cover">';?></div>
            <div class="book-info">
                <h2><?php echo $book['Titolo']; ?></h2><br>
                <h3><?php echo "Autor:" ?> </h3> <p><?php $book['Autore'] ?> </p> <?php echo "<h3>        N. Pages: </h3> <p>" . $book['Numero_Pagine']. "</p>"?>
                <h3><?php echo "Publisher:" . $book['Casa_Editrice']; ?></h3>
                <h3><?php echo "Date:" . date('Y', strtotime($book['Data_Pubblicazione'])); ?></h3>
                <h3><?php echo "Genre:" . $book['Genere']; ?></h3>
            </div>
        </div>

        <h3>Plot</h3>
        <p><?php echo $book['Trama']; ?></p>
    </div>
</body>

</html>