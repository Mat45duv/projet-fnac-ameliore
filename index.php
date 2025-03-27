<?php
// Démarre la session
session_start();

// Vérifie si l'utilisateur est connecté et a le rôle d'administrateur
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Si l'utilisateur n'est pas un administrateur, le rediriger vers la page de connexion ou une autre page
    header('Location: index_client.php');
    exit();
}

// Vérifiez si un message de succès est passé dans l'URL
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<p id="success-message" class="success-message">Les modifications du livre ont été enregistrées avec succès !</p>';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style1.css">
    <title>Fnac front</title>
    <script>
        // Fonction pour masquer le message après 5 secondes
        window.onload = function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = 'none';
                }, 5000); // Masquer après 5 secondes
            }
        };
    </script>
</head>

<body>
    <h1>Fnac: recherche dans le catalogue</h1>
    
    <form action="recherche.php" method="GET">
        <label for="choix">Rechercher par :</label>
        <select name="choix" id="choix" required>
            <option value="titre">Titre</option>
            <option value="auteur">Auteur</option>
            <option value="isbn">Numéro ISBN</option>
        </select>
        
        <label for="carac">Entrez une chaîne de caractères pour la recherche :</label>
        <input type="text" name="carac" placeholder="Entrez votre recherche" required>
        
        <button type="submit">Chercher</button>
    </form>

    <p><a href="ajout_livre.php">Ajouter un livre</a></p>
    
    <!-- Lien vers la page de modification de livre -->
    <p><a href="modif_livre.php">Modifier un livre</a></p>

    <p><a href="fnac_front.php">Bibliothèque des livres</a></p>

    <!-- Bouton de déconnexion -->
    <p><a href="index_client.php" class="logout-button">Déconnexion</a></p>
</body>

</html>
