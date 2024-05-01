<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        setTimeout(function() {
            window.location.href = 'book.php?id=' + <?php echo ((db_connection("SELECT ID_Libro FROM libri ORDER BY ID_Libro DESC LIMIT 1"))['ID_Libro']) ?>;
        }, 5000);
    </script>

    <style>
        .page {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Online</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://fonts.cdnfonts.com/css/fonseca" rel="stylesheet">
    <header>

        <div class="container">
            <h1>Biblioteca Online</h1>
        </div>
    </header>
</head>

<body>
    <div class="page">
        <?php
        define('UPLOAD_DIR', 'C:/Users/matte/Documents/Scuola/Informatica/PHP-Library/uploads');

        if (isset($_FILES['immagine'])) {   //recupero il nome
            $file = $_FILES['immagine'];
            $bookCoverName = $file['name'];


            //se è tutto ok definismo il percorso e metto l'immagine nella cartella(controlliamo anche che sia stato caricato in upload
            //con tmp_name is_uploaded_file)
            if ($file['error'] == UPLOAD_ERR_OK and is_uploaded_file($file['tmp_name'])) {
                //percorso e muovo il file fisicamente
                $percorso = UPLOAD_DIR . $file['name'];
                move_uploaded_file($file['tmp_name'], UPLOAD_DIR . $file['name']);
            }
        }


        $bookTitle = $_POST['book-title'];
        $bookAuthor = $_POST['book-author'];
        $bookPublisher = $_POST['book-publisher'];
        $bookYear = $_POST['book-year'] . "/01/01";
        $bookGenre = $_POST['book-genre'];
        $trama = $_POST['trama'];
        $pages = $_POST['book-pages'];

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
            foreach($res as $value){
                return $value;
            }

            
        }



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


        $sql = "INSERT INTO libri (Copertina, Titolo, Autore, Data_Pubblicazione, Genere, Trama, Numero_Pagine, Casa_Editrice)
VALUES ('$bookCoverName', '$bookTitle', '$bookAuthor', '$bookYear', '$bookGenre', '$trama', '$pages', '$bookPublisher')";


        $res = $conn->query($sql);

        if ($res === TRUE) {
            echo "<h2>New book added successfully</h2>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        echo "<h3>Redirecting...</h3>";

        $conn->close();







        ?>

    </div>



</body>


</html>