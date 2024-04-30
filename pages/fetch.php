<?php


define('UPLOAD_DIR', 'C:/Users/matte/Desktop/PHP-Library/uploads/');

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
$bookYear = $_POST['book-year'];
$bookGenre = $_POST['book-genre'];
$trama = $_POST['trama'];









$servername = "darkangel-9653.7tc.aws-eu-central-1.cockroachlabs.cloud";
$username = "darkangel";
$password = "iRRzdJ8POYpLaHmsOk54Xw";
$dbname = "libri";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$sql = "INSERT INTO books (bookCoverName, bookTitle, bookAuthor, bookPublisher, bookYear, bookGenre, trama)
VALUES ('$bookCoverName', '$bookTitle', '$bookAuthor', '$bookPublisher', '$bookYear', '$bookGenre', '$trama')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: ". $sql. "<br>". $conn->error;
}

$conn->close();



?>
