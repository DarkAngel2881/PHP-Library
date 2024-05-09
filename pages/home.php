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
    <link rel="stylesheet" href="/css/searchbar.css">
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <header>

        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>

        <div class="navbar">
            <button class="btn btn-primary btn-hover" onclick="location.href='home.php';">Home</button>
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="What do you want to read..." />
                <button type="reset"></button>
            </form>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Generi</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro +</button>
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
        <?php
        $genre = db_connection("SELECT DISTINCT Genere FROM libri WHERE genere IS NOT NULL");
        foreach ($genre as $row) {
            $bookrow = db_connection("SELECT Copertina, ID_Libro, Genere, generi.Icon FROM libri JOIN generi ON libri.Genere = generi.Nome WHERE Genere = '" . $row['Genere'] . "'");
            echo "<h2>" . ($bookrow->fetch_assoc())['Icon'] . $row['Genere'] . "</h2>";
            echo '<div class="book-scroll dragscroll">';

            

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
            echo '</div><br><br>';
        }
        ?>

    </div>

</body>

</html>