<?php
// Connexion à la base de données
require 'db_connect.php';

// Récupérer tous les livres
$query = "SELECT * FROM books";
$stmt = $connection->prepare($query);
$stmt->execute();
$livres = $stmt->fetchAll();

// Vérifier si un message de succès est passé dans l'URL
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<p id="success-message" class="success-message">Les modifications du livre ont été enregistrées avec succès !</p>';
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style2.css">
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
    <h1>Fnac: Recherche dans le catalogue</h1>
    
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
    
    </div>
    <p><a href="ajout_livre.php">Ajouter un livre</a></p>
    
    <!-- Lien vers la page de modification de livre -->
    <p><a href="modif_livre.php">Modifier un livre</a></p>

    <p><a href="supprimer_livre.php">Supprimer un livre</a></p>

    <!-- Afficher tous les livres comme une bibliothèque -->
    <div class="library">
        <?php if ($livres): ?>
            <?php foreach ($livres as $livre): ?>
                <div class="book-card">
                    <h3><?php echo htmlspecialchars($livre['title']); ?></h3>
                    <p>Auteur: <?php echo htmlspecialchars($livre['author']); ?></p>
                    <p>ISBN: <?php echo htmlspecialchars($livre['isbn']); ?></p>
                    <p>Prix: <?php echo htmlspecialchars($livre['price']); ?> €</p>
                    <a href="modif_livre.php?isbn=<?php echo htmlspecialchars($livre['isbn']); ?>" class="button-link">Modifier</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun livre disponible dans le catalogue.</p>
        <?php endif; ?>
    </div>
    

</body>

</html>
