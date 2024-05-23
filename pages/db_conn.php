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
}