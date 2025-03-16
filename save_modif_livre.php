<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $isbn = $_POST['isbn']; // ISBN pour identifier le livre
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    // Utilisation d'une requête préparée pour éviter les injections SQL
    try {
        $query = "UPDATE books SET title = ?, author = ?, price = ? WHERE isbn = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$title, $author, $price, $isbn]);

        // Redirection vers la page d'index avec un message de succès
        header('Location: index.php?success=true');
        exit();
    } catch (Exception $e) {
        // En cas d'erreur, vous pouvez gérer l'erreur ici
        echo "Erreur lors de la mise à jour du livre : " . $e->getMessage();
    }
}
?>
