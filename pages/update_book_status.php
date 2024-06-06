<?php
require "db_conn.php";
session_start();
$username = $_SESSION['username'];

if (isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    $id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];
    db_connection("UPDATE libri SET is_taken = 1 WHERE ID_Libro = $bookId");
    db_connection("INSERT INTO prestiti (
        ID_Utente,
        ID_Libro,
        Data_Prestito,
        Data_Restituzione
      )
    VALUES (
        $id_user,
        $bookId,
        '".date("Y-m-d")."',
        '".date("Y-m-d", strtotime("+15 days"))."'
      );");
    header("Location: book.php?id=$bookId");
    exit;
}
?>