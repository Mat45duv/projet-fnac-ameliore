<?php
require 'db_connect.php';

$str = isset($_GET["carac"]) ? $_GET["carac"] : '';
$selection = isset($_GET["choix"]) ? $_GET["choix"] : '';

if ($selection == "titre") {
    $sql = "SELECT * FROM books WHERE title LIKE '%" . $str . "%'";
} elseif ($selection == "isbn") {
    $sql = "SELECT * FROM books WHERE isbn LIKE '%" . $str . "%'";
} elseif ($selection == "auteur") {
    $sql = "SELECT * FROM books WHERE author LIKE '%" . $str . "%'";
}

$table = $connection->query($sql);
$count = $table->rowCount();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Résultats de la recherche</title>
</head>

<body>
    <header>
        <h1>Résultats de la Recherche</h1>
    </header>

    <main>
        <div class="livres-container">
            <?php if ($count > 0) : ?>
                <h2><?= $count ?> résultat(s) trouvé(s)</h2>
                <?php while ($ligne = $table->fetch()) : ?>
                    <div class="livre">
                        <h2><?= $ligne['title']; ?></h2>
                        <p class="<?= ($selection == "auteur") ? 'gras' : ''; ?>">Auteur: <?= $ligne['author']; ?></p>
                        <p>ISBN: <?= $ligne['isbn']; ?></p>
                        <p>Prix: <?= $ligne['price']; ?></p>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>Aucun résultat trouvé.</p>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>

<?php
// Fermez la connexion
$table->closeCursor();
?>



