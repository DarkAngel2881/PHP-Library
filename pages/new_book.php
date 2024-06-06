<?php
require "db_conn.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/test-style.css">
    <link rel="stylesheet" href="/css/searchbar.css">
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <title>Document</title>
    <style>
        .book {
            display: none;
        }

        .book-info {
            margin-left: 20px;
        }

        input[type="file"] {
            display: none;
        }

        .cover_input {
            display: inline-block;
            width: 120px;
            height: 192px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            background-image: url("/resources/plus.svg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: 40%;
            background-color: grey;
            border: none;
            cursor: pointer;
            text-align: center;
            vertical-align: center;
            font-family: 'Fonseca', sans-serif;
            font-size: 0.8em;
            margin: auto;
            -webkit-tap-highlight-color: transparent;
        }

        h3 {
            text-align: left;
            margin: 0;
            margin-bottom: 0.5em;
        }
    </style>
    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>
        <div class="navbar">
            <button class="btn btn-success btn-hover" onclick="location.href='home.php';">Home</button>
            <form class="search-box" action="search.php">
                <input type="text" name="query" placeholder="What do you want to read..." />
                <button type="reset"></button>
            </form>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.php';">Generi</button>
            <?php
            if (isset($_SESSION['username'])) {
                if ($_SESSION['is_admin']) {
                    echo '<button class="btn btn-success btn-hover" onclick="location.href=\'new_book.php\';">Libro +</button>';
                }
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'profile.php\';">Profilo</button>';
            } else {
                echo '<button class="btn btn-success btn-hover" onclick="location.href=\'login.php\';">Login/Sign Up</button>';
            }
            ?>
        </div>
    </header>
</head>

<body>
    <br>
    <div id="background"></div>
    <div class="page">
        <h2 style="margin-left: 10px;">New Book</h2>
        <!-- Form for the book details -->
        <form action="fetch.php" method="post" enctype="multipart/form-data">
            <div class="book-details">
                <div id="book" class="book"><img id="book-cover" class="book-cover" src="" alt="Book Cover"></div>
                <label class="cover_input" id="book-button"><input type="file" id="immagine" name="immagine" accept="image/png, image/jpeg"></label>
                <div id="book-info" class="book-info">
                    <input type="text" id="book-title" name="book-title" placeholder="Title">
                    <input type="number" name="book-pages" id="book-pages" placeholder="N. Pages"><br><br>
                    <input type="text" id="book-author" name="book-author" placeholder="Author"><br><br>
                    <input type="text" id="book-publisher" name="book-publisher" placeholder="Publisher"><br><br>
                    <input type="number" id="book-year" name="book-year" placeholder="Year" min="0" max="<?php echo date("Y") ?>" step="1"><br><br>
                    <select type="" id="book-genre" name="book-genre" placeholder="Genre">
                        <option value="none" selected disabled hidden>Genre</option>
                        <?php
                        $genres = db_connection("SELECT Nome FROM generi;");

                        foreach ($genres as $genre) {
                            echo "<option value='" . $genre["Nome"] . "'>" . $genre['Nome'] . "</option>";
                        }
                        ?>
                    </select>


                </div>
            </div>
            <!-- Plot text box -->
            <h3>Trama</h3>
            <textarea name="trama" id="trama" cols="100" rows="10" placeholder="trama del libro"></textarea>
            <br>

            <input class="button1" type="submit" value="Submit" id="submit-button">
        </form>
    </div>

    <script>
        // When cover image get entered the button gets replaced by the image
        const bookButton = document.getElementById('book-button');
        const book = document.getElementById('book');
        const bookCover = document.getElementById('book-cover');
        const bookInfo = document.getElementById('book-info');

        bookButton.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const url = URL.createObjectURL(file);
            bookCover.src = url;
            book.style.display = 'block';
            bookButton.style.display = 'none';
            bookInfo.style.marginLeft = '0px';
        });
    </script>
</body>

</html>