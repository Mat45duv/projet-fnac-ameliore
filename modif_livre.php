<!-- modif_livre.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Modifier un Livre</title>
</head>

<body>
    <header>
        <h1>Modifier un Livre</h1>
    </header>

    <main>
        <form action="traitement_modif_livre.php" method="POST">
            <label for="book">Sélectionnez un Livre :</label>
            <select name="book" required>
                <?php
                // Récupération de tous les livres
                $query = "SELECT * FROM books";
                $result = $connection->query($query);

                while ($row = $result->fetch()) {
                    echo "<option value='{$row['isbn']}'>{$row['title']}</option>";
                }
                ?>
            </select>

            <button type="submit">Modifier Livre</button>
        </form>
    </main>

</body>

</html>
