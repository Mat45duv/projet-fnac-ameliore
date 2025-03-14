<!-- ajout_livre.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un Livre</title>
</head>

<body>
    <header>
        <h1>Ajouter un Livre</h1>
    </header>

    <main>
        <form action="traitement_ajout_livre.php" method="POST">
            <label for="title">Titre :</label>
            <input type="text" name="title" required>

            <label for="author">Auteur :</label>
            <input type="text" name="author" required>

            <label for="isbn">ISBN :</label>
            <input type="text" name="isbn" required>

            <label for="price">Prix :</label>
            <input type="text" name="price" required>

            <button type="submit">Ajouter Livre</button>
        </form>
    </main>

</body>

</html>
