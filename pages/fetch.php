<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php




    $target_dir = "/uploads/";
    $target_file = $target_dir . basename($_FILES["immagine"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["immagine"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["immagine"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
   
    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        try {move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file);}
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            
        }
    }
    
    echo "<br><br>";


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
    <img src="/uploads/<?php echo $bookCoverName ?>" alt="">

</body>

</html>