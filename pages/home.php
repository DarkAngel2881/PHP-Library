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
            <button class="btn btn-primary btn-hover" onclick="location.href='home.html';">Home</button>
            <button class="btn btn-secondary btn-hover" onclick="location.href='search.html';">Cerca</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Categorie</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Tendenza</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro+</button>
        </div>
    </header>
</head>

<body>
    <div class="page">
        <div class="book-scroll dragscroll">

            <h2>Sci-Fi</h2>
            <?php
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

            $sql = "SELECT Copertina FROM libri;";

            $conn = $conn->query($sql);
            $i = 0;
            foreach ($conn as $copertina) {
                if ($i <= 7) {
                    $i++;
                    echo '<div class="book">
                            <img src="/resources/' .$copertina['Copertina']. '" alt="Book cover" class="book-cover">
                          </div>';
                }
            }


            $conn->close();


            ?>
            <!--
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
            -->

        </div>

        <h2>Fantasy</h2>
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

        </div>

    </div>

</body>

</html>