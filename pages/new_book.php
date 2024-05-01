<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
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
    </style>
    <header>
        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>
        <div class="navbar">
            <button class="btn btn-primary btn-hover" onclick="location.href='home.html';">Home</button>
            <button class="btn btn-secondary btn-hover" onclick="location.href='search.html';">Cerca</button>
            <button class="btn btn-success btn-hover" onclick="location.href='genres.html';">Categorie</button>
            <button class="btn btn-success btn-hover" onclick="location.href='trends.html';">Tendenza</button>
            <button class="btn btn-success btn-hover" onclick="location.href='new_book.php';">Libro+</button>
        </div>
    </header>
</head>

<body>

    <div class="page">
        <h2 style="margin-left: 10px;">new book</h2>
        <form action="fetch.php" method="post" enctype="multipart/form-data">
            <div class="book-details">
                <div id="book" class="book"><img id="book-cover" class="book-cover" src="" alt="Book Cover"></div>
                <!--<input id="book-button" name="bookCover" class="book-button">-->
                <label class="cover_input" id="book-button"><input type="file" id="immagine" name="immagine" accept="image/png, image/jpeg"></label>
                <div id="book-info" class="book-info">
                    <input type="text" id="book-title" name="book-title" placeholder="Title">
                    <input type="number" name="book-pages" id="book-pages" placeholder="N. Pages"><br><br>
                    <input type="text" id="book-author" name="book-author" placeholder="Author"><br><br>
                    <input type="text" id="book-publisher" name="book-publisher" placeholder="Publisher"><br><br>
                    <input type="number" id="book-year" name="book-year" placeholder="Year" min="0" max="<?php echo date("Y") ?>" step="1"><br><br>
                    <select type="" id="book-genre" name="book-genre" placeholder="Genre">
                        <option value="none" selected disabled hidden>Genre</option>
                        <?php $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "libri";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT Icon, Nome FROM generi;";

                        $conn = $conn->query($sql);

                        foreach ($conn as $genre) {
                            echo "<option value='" . $genre["Nome"] . "'>" . $genre['Icon'] . $genre['Nome'] . "</option>";
                        }

                        $conn->close(); ?>

                        <!--<option value="fantasy">🧙🏻‍♂️Fantasy</option>
                        <option value="horror">💀Horror</option>
                        <option value="romance">💘Romance</option>
                        <option value="thriller">😱Thriller</option>
                        <option value="comedy">🤣Comedy</option>
                        <option value="drama">🥹Drama</option>
                        <option value="action">🔫Action</option>
                        <option value="scifi">🛸Sci-Fi</option>
                        <option value="adventure">⛵Adventure</option>
                        <option value="science">🔬Science</option>
                        <option value="literature">✍🏻Literature</option>
                        <option value="history">🕰️History</option>
                        <option value="biography">🧑🏻Biography</option>
                        <option value="comics">💬Comics</option>
                        <option value="manga">⛩️Manga</option>
                        <option value="children">👦🏻Children</option>
                        <option value="crime">🕵🏻Crime</option>
                        <option value="food">🍴Food</option>
                        -->
                    </select>


                </div>
            </div>

            <h3>Trama</h3>
            <textarea name="trama" id="trama" cols="100" rows="10" placeholder="trama del libro"></textarea>
            <br>

            <input type="submit" value="Submit" id="submit-button">
        </form>
    </div>

    <script>
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