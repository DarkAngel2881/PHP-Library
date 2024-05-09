<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/filters.css">
    <style>
        @import url("https://fonts.googleapis.com/css?family=Raleway:400,400i,700");

        .search-box {
            font-size: 20px;
            border: solid 0.2em #000;
        }

        .search-box input[type="text"] {
            background-color: white;
            color: black;
            width: 2.5em;
            height: 2.5em;
            padding: 0.3em 2.1em 0.3em 0.4em;
        }

        .search-box input[type="text"]:focus,
        .search-box input[type="text"]:not(:placeholder-shown) {
            width: 25em;
        }

        .search-box button[type="reset"]:before,
        .search-box button[type="reset"]:after {
            background-color: #000;
        }
    </style>
    <style>
        .search {
            display: flex;
            flex-direction: row;

        }
    </style>
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <header>

        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>

        <div class="navbar">
            <button class="btn btn-primary btn-hover" onclick="location.href='home.php';">Home</button>
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
    }
    function get_query($query=null, $genre = null, $year = null)
    {
        $sql = "SELECT * FROM libri WHERE (Titolo LIKE '%$query%' OR Autore LIKE '%$query%' OR Casa_Editrice LIKE '%$query%')";
        if (!empty($genre)) {
            $sql .= " AND Genere = '$genre'";
        }
        if (!empty($year)) {
            $sql .= " AND Data_Pubblicazione = '$year/01/01'";
        }
        // echo $sql;
        return db_connection($sql);
    }

    ?>
    <br>
    <div class="page">
        <div class="search">
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="Search for title, author or publisher" />
                <button type="reset"></button>
            </form>
            <button class="setting-btn">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar1"></span>
            </button>
        </div>


        <div class="searched-books">
            <?php
                $query = isset($_GET['query']) ? $_GET['query'] : null;
                $genre = isset($_GET['genre']) ? $_GET['genre'] : null;
                $year = isset($_GET['year']) ? $_GET['year'] : null;
                foreach (get_query($query, $genre, $year) as $book) {
                    $i = 0;
                    if ($i <= 20) {
                        $i++;
                        echo '<div class="book">
                             <img onclick="location.href=\'book.php?id=' . $book['ID_Libro'] . '\'" src="/uploads/' . $book['Copertina'] . '" alt="Book cover" class="book-cover">
                          </div>';
                    }
                }

            ?>
        </div>

        <div class="filter-interface">
            <form action="search.php" method="get">
            <input type="hidden" name="query" value="<?php echo htmlspecialchars($query);?>">
                <div class="filter-option">
                    <label class="filter-label">Genre</label>
                    <select class="filter-select" type="" id="genre" name="genre">
                        <option value="none" selected disabled hidden></option>
                        <?php
                        $sql = "SELECT Icon, Nome FROM generi;";

                        $genres = db_connection($sql);

                        foreach ($genres as $genre) {
                            echo "<option value='" . $genre["Nome"] . "'>" . $genre['Icon'] . $genre['Nome'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="filter-option">
                    <label class="filter-label">Year</label>
                    <input class="filter-input" type="number" id="year" name="year">
                </div>
                <button class="filter-button">Apply filters</button>
            </form>
        </div>





    </div>

    <script>
        const settingsButton = document.querySelector('.setting-btn');
        const filterInterface = document.querySelector('.filter-interface');

        settingsButton.addEventListener('click', () => {
            filterInterface.classList.toggle('visible');
        });
    </script>

</body>

</html>