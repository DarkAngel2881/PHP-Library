<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    <?php
$bookCover = $_FILES['bookCover'];
$bookCoverTmpName = $_FILES['bookCover']['tmp_name'];
$bookCoverName = $_FILES['bookCover']['name'];
move_uploaded_file($bookCoverTmpName, '/uploads'. $bookCoverName);


$bookTitle = $_POST['book-title'];
$bookAuthor = $_POST['book-author'];
$bookPublisher = $_POST['book-publisher'];
$bookYear = $_POST['book-year'];
$bookGenre = $_POST['book-genre'];
$trama = $_POST['trama'];

echo $bookTitle . "<br>";
echo $bookAuthor . "<br>";
echo $bookPublisher . "<br>";
echo $bookYear . "<br>";
echo $bookGenre . "<br><br>";




?>    
<img src="/uploads/<?php echo $bookCoverName;?>" alt="Book Cover">

</body>
</html>

