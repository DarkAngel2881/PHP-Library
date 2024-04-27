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
        </div>
    </header>
</head>

<body>

    <div class="page">
        <div class="book-details">
            <div id="book" class="book"><img id="book-cover" class="book-cover" src="" alt="Book Cover"></div>
            <button id="book-button" class="book-button"></button>
            <div id="book-info" class="book-info">
                <input type="text" id="book-title" placeholder="Book Title">
                <input type="text" id="book-author" placeholder="Author Name">
                <input type="text" id="book-publisher" placeholder="Publisher Name">
                <input type="text" id="book-year" placeholder="Year">
                <input type="text" id="book-genre" placeholder="Genre">
            </div>
        </div>

        <h3>Trama</h3>
    </div>

    <script>
        const bookButton = document.getElementById('book-button');
        const book = document.getElementById('book');
        const bookCover = document.getElementById('book-cover');
        const bookInfo = document.getElementById('book-info');

        bookButton.addEventListener('click', () => {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';

            input.addEventListener('change', () => {
                const file = input.files[0];
                const reader = new FileReader();

                reader.addEventListener('load', () => {
                    bookCover.src = reader.result;
                    book.style.display = 'inline-block';
                    bookButton.style.display = 'none';
                    bookInfo.style.marginLeft = '0px';
                });
                reader.readAsDataURL(file);
            });

            input.click();
        });
    </script>
</body>

</html>