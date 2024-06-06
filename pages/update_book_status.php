<?php
// Require the database connection file
require "db_conn.php";

// Start the session
session_start();

// Get the username from the session
$username = $_SESSION['username'];

// Check if the book ID is posted
if (isset($_POST['book_id'])) {
    // Get the book ID
    $bookId = $_POST['book_id'];
    
    // Get the user ID from the database
    $id_user = (db_connection("SELECT ID_Utente FROM utente WHERE Nome = '$username'"))->fetch_assoc()['ID_Utente'];
    
    // Update the book status to taken
    db_connection("UPDATE libri SET is_taken = 1 WHERE ID_Libro = $bookId");
    
    // Insert a new loan into the prestiti table
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
      
    // Redirect to the book page
    header("Location: book.php?id=$bookId");
    exit;
}
?>