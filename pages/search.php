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
    <style>
        @import url("https://fonts.googleapis.com/css?family=Raleway:400,400i,700");
        .search-box {
            font-size: 20px;
            border: solid 0.3em #000;
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
    } ?>
    <br>
    <div class="page">
        <form class="search-box">
            <input type="text" placeholder="Search for title, author or publisher" />
            <button type="reset"></button>
        </form>


    </div>

    <script>
        document.getElementById('filter-button').addEventListener('click', function() {
            document.getElementById('filter-scroll-box').style.display = 'block';
        });
    </script>

</body>

</html>