<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];
    $price = $_POST['price'];

    // Utilisation de requête paramétrée pour éviter les injections SQL
    $query = "INSERT INTO books (title, author, isbn, price) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->execute([$title, $author, $isbn, $price]);

    // Redirection après l'ajout
    header('Location: ajout_livre.php?success=true');
    exit();
}
?>
