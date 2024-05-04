<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/scripts/dragscroll.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bookScroll = document.querySelector('.book-scroll');
            new dragscroll(bookScroll);
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <header>

        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>

        <div class="navbar">
            <button class="btn btn-primary btn-hover" onclick="location.href='home.php';">Home</button>
            <button class="btn btn-secondary btn-hover" onclick="location.href='search.html';">Cerca</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Categorie</button>
            <button class="btn btn-success btn-hover" onclick="location.href='tendenze.html';">Tendenza</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro+</button>
        </div>
    </header>
</head>

<body>
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

        $conn->close();

        return $res;
    } ?>
    <br>
    <div class="page">
        <div class="book-scroll dragscroll">
            <?php $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere, generi.Icon FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = 'Sci-Fi'"); ?>

            <h2><?php echo ($bookrow->fetch_assoc())['Icon']; ?>Sci-Fi</h2>

            <?php
            $i = 0;
            foreach ($bookrow as $libro) {
                if ($i <= 7) {
                    $i++;
                    echo '<div class="book">
                             <img onclick="location.href=\'book.php?id=' . $libro['ID_Libro'] . '\'" src="/uploads/' . $libro['Copertina'] . '" alt="Book cover" class="book-cover">
                          </div>';
                }
            }
            $bookrow->close();
            ?>
        </div><br><br>
        <div class="book-scroll dragscroll">
            <?php $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere, generi.Icon FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = 'Drama'"); ?>

            <h2><?php echo ($bookrow->fetch_assoc())['Icon']; ?>Drama</h2>

            <?php
            $i = 0;
            foreach ($bookrow as $libro) {
                if ($i <= 7) {
                    $i++;
                    echo '<div class="book">
                             <img onclick="location.href=\'book.php?id=' . $libro['ID_Libro'] . '\'" src="/uploads/' . $libro['Copertina'] . '" alt="Book cover" class="book-cover">
                          </div>';
                }
            }
            $bookrow->close();
            ?>
        </div><br><br>
        <div class="book-scroll dragscroll">
            <?php $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere, generi.Icon FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = 'Fantasy'"); ?>

            <h2><?php echo ($bookrow->fetch_assoc())['Icon']; ?>Fantasy</h2>

            <?php
            $i = 0;
            foreach ($bookrow as $libro) {
                if ($i <= 7) {
                    $i++;
                    echo '<div class="book">
                             <img onclick="location.href=\'book.php?id=' . $libro['ID_Libro'] . '\'" src="/uploads/' . $libro['Copertina'] . '" alt="Book cover" class="book-cover">
                          </div>';
                }
            }
            $bookrow->close();
            ?>
        </div>
        <br><br>
        <h2>All</h2>
        <div class="book-scroll dragscroll">
            <div class="book">
                <img src="/resources/1984.jpg" alt="Book cover" class="book-cover">
            </div>
            <div class="book">
                <img src="/resources/American-psycho.jpg" alt="Book cover" class="book-cover">
            </div>
            <div class="book">
                <img src="/resources/Harry-potter.jpg" alt="Book cover" class="book-cover">
            </div>
            <div class="book">
                <img src="/resources/Hunger-Games.jpg" alt="Book cover" class="book-cover">
            </div>
            <div class="book">
                <img src="/resources/Lord-of-the-rings.jpg" alt="Book cover" class="book-cover">
            </div>
            <div class="book">
                <img src="/resources/The-Little-Prince.jpg" alt="Book cover" class="book-cover">
            </div>
        </div>

    </div>

</body>

</html>