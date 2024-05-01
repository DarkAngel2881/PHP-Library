<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php
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

        $sql = "SELECT Icon, Nome FROM generi;";

        $conn = $conn->query($sql);

        foreach ($conn as $genre) {
            echo $genre['Nome'];
        }

        $conn->close(); ?>

    <select name="generi" id="generi">
        <?php
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

        $sql = "SELECT Icon, Nome FROM generi;";

        $conn = $conn->query($sql);

        foreach ($conn as $genre) {
            echo "<option value='" . strtolower($genre["Nome"]) . "'>" . $genre['Icon'] . "</option>";
        }

        $conn->close(); ?>
        </select>



</body>

</html>