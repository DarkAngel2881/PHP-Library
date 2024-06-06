<?php
// Include the database connection file
require "db_conn.php";
?>

<!-- HTML document starts here -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags and CSS links -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link rel="stylesheet" href="/css/filters.css">
    <!-- Import Google Fonts -->
    <style>
        @import url("https://fonts.googleapis.com/css?family=Raleway:400,400i,700");

        /* Styles for the search box */
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
        /* Styles for the search container */
        .search {
            display: flex;
            flex-direction: row;
        }
    </style>
    <!-- Import Fonseca font -->
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
</head>

<body>
    <?php
    // Function to get query results from the database
    function get_query($query = null, $genre = null, $year = null)
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

    <!-- Header section -->
    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>

        <!-- Navigation bar -->
        <div class="navbar">
            <!-- Home button -->
            <button class="btn btn-primary btn-hover" onclick="location.href='home.php';">Home</button>
            <!-- Genres button -->
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
            <!-- New book button -->
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro +</button>
        </div>
    </header>

    <!-- Page content -->
    <div class="page">
        <br>
        <div id="background"></div>
        <div class="search">
            <!-- Search form -->
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="Search for title, author or publisher" />
                <button type="reset"></button>
            </form>
            <!-- Settings button -->
            <button class="setting-btn">
                <span class="bar bar1"></span>
                <span class="bar bar2"></span>
                <span class="bar bar1"></span>
            </button>
        </div>

        <!-- Display searched books -->
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

        <!-- Filter interface -->
        <div class="filter-interface">
            <!-- Form to apply filters -->
            <form action="search.php" method="get">
                <!-- Hidden input to store the query -->
                <input type="hidden" name="query" value="<?php echo htmlspecialchars($query); ?>">

                <!-- Genre filter option -->
                <div class="filter-option">
                    <label class="filter-label">Genre</label>
                    <select class="filter-select" type="" id="genre" name="genre">
                        <!-- Option to select no genre -->
                        <option value="none" selected disabled hidden></option>
                        <?php
                        // Get genres from the database
                        $sql = "SELECT Nome FROM generi;";

                        $genres = db_connection($sql);

                        // Loop through genres and create options
                        foreach ($genres as $genre) {
                            echo "<option value='" . $genre["Nome"] . "'>" . $genre['Nome'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Year filter option -->
                <div class="filter-option">
                    <label class="filter-label">Year</label>
                    <input class="filter-input" type="number" id="year" name="year">
                </div>

                <!-- Apply filters button -->
                <button class="filter-button">Apply filters</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to toggle the filter interface -->
    <script>
        const settingsButton = document.querySelector('.setting-btn');
        const filterInterface = document.querySelector('.filter-interface');

        settingsButton.addEventListener('click', () => {
            filterInterface.classList.toggle('visible');
        });
    </script>
</body>

</html>