<?php
// Affichage du message de confirmation si un livre a été ajouté avec succès
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<p class="success-message">Le livre a été ajouté avec succès !</p>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Ajouter un Livre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            width: 100%;
        }
        main {
            background: white;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
        }
        input, textarea {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #27ae60;
            color: white;
            padding: 10px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #219150;
        }
        .button-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
        .button-link:hover {
            background-color: #1f6690;
        }
    </style>
</head>
<body>
    <header>
        <h1>Ajouter un Livre</h1>
    </header>

    <main>
        <form action="traitement_ajout_livre.php" method="POST">
            <label for="id">ID :</label>
            <input type="number" name="id" required>

            <label for="title">Titre :</label>
            <input type="text" name="title" required>

            <label for="author">Auteur :</label>
            <input type="text" name="author" required>

            <label for="isbn">ISBN :</label>
            <input type="text" name="isbn" required>

            <label for="price">Prix :</label>
            <input type="text" name="price" required>

            <label for="description">Description :</label>
            <textarea name="description" required></textarea>

            <label for="publisher">Éditeur :</label>
            <input type="text" name="publisher" required>

            <label for="publish_date">Date de Publication :</label>
            <input type="date" name="publish_date" required>

            <label for="rating">Note :</label>
            <input type="number" name="rating" step="0.1" min="0" max="5" required>

            <label for="image_url">URL de l'Image :</label>
            <input type="url" name="image_url" required>

            <button type="submit">Ajouter Livre</button>
        </form>

        <a href="index.php" class="button-link">Retour à l'Index</a>
    </main>
</body>
</html>