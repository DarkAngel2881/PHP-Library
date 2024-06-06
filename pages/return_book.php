<?php
require "db_conn.php";
session_start();

$bookId = $_POST['book_id'];
$username = $_SESSION['username'];
$id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];

// Update the book status to available
$query = "UPDATE libri SET is_taken = 0 WHERE ID_Libro = $bookId";
db_connection($query);

// Delete the loan record
$query = "DELETE FROM prestiti WHERE ID_Libro = $bookId AND ID_Utente = $id_user";
db_connection($query);

// Redirect to the book page with a success message
header("Location: book.php?id=$bookId");
exit;
