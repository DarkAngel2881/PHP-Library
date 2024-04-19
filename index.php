<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="styles.css"> <!-- Assicurati di collegare il tuo foglio di stile CSS qui -->
    <style>
        /* Stili inline per esempio, ma preferibilmente usa un file esterno styles.css */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #007bff;
            color: #fff;
            padding: 1em 0;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            font-size: 2.5em;
        }
        /* Stili per la sezione dei libri */
        .books {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }
        .book {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            width: calc(33.33% - 40px);
            text-align: center;
        }
        .book img {
            max-width: 100%;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .book h3 {
            margin-top: 10px;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Benvenuto nella Biblioteca Online</h1>
            <p>Esplora la nostra vasta collezione di libri</p>
        </div>
    </header>

    <div class="container">
        <h2>Ultimi Arrivi</h2>
        <div class="books">
            <!-- Esempio di libro -->
            <div class="book">
                <img src="book1.jpg" alt="Libro 1">
                <h3>Titolo del Libro</h3>
                <p>Autore del Libro</p>
                <button>Dettagli</button>
            </div>
            <!-- Esempio di libro -->
            <div class="book">
                <img src="book2.jpg" alt="Libro 2">
                <h3>Titolo del Libro</h3>
                <p>Autore del Libro</p>
                <button>Dettagli</button>
            </div>
            <!-- Esempio di libro -->
            <div class="book">
                <img src="book3.jpg" alt="Libro 3">
                <h3>Titolo del Libro</h3>
                <p>Autore del Libro</p>
                <button>Dettagli</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2024 Biblioteca Online. Tutti i diritti riservati.</p>
        </div>
    </footer>
</body>
</html>