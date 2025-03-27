<?php
// Connexion à la base de données
try {
    $dsn = 'mysql:host=localhost;dbname=livres;charset=utf8';
    $utilisateur = 'root';
    $motDePasse = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    $connection = new PDO($dsn, $utilisateur, $motDePasse, $options);
} catch (Exception $e) {
    die("❌ Connexion échouée : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <title>Modifier un Livre</title>
</head>
<body>
    <header>
        <h1>Modifier un Livre</h1>
    </header>

    <main>
        <form action="traitement_modif_livre.php" method="POST">
            <label for="book">Sélectionnez un Livre :</label>
            <select name="book" id="book" required>
                <?php
                try {
                    $query = "SELECT isbn, title FROM books ORDER BY title ASC";
                    $result = $connection->query($query);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch()) {
                            echo "<option value='{$row['isbn']}'>{$row['title']}</option>";
                        }
                    } else {
                        echo "<option disabled>Aucun livre disponible</option>";
                    }
                } catch (Exception $e) {
                    echo "<option disabled>Erreur de chargement des livres</option>";
                }
                ?>
            </select>
            <button type="submit">Modifier Livre</button>
        </form>
    </main>
</body>
</html>