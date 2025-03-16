<?php
// Vérifier si un livre a été sélectionné
if (!isset($_POST['book']) || empty($_POST['book'])) {
    die("❌ Aucun livre sélectionné.");
}

// Récupération de l'ISBN du livre sélectionné
$isbn = $_POST['book'];

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

// Récupération des informations du livre sélectionné
try {
    $query = "SELECT * FROM books WHERE isbn = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$isbn]);
    $livre = $stmt->fetch();

    if (!$livre) {
        die("❌ Livre introuvable.");
    }
} catch (Exception $e) {
    die("❌ Erreur lors de la récupération du livre : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Modifier le Livre</title>
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
        <h1>Modifier le Livre</h1>
    </header>

    <main>
        <form action="save_modif_livre.php" method="POST">
            <input type="hidden" name="isbn" value="<?php echo htmlspecialchars($livre['isbn']); ?>">

            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($livre['title'] ?? ''); ?>" required>

            <label for="author">Auteur :</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($livre['author'] ?? ''); ?>" required>

            <label for="isbn">ISBN :</label>
            <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($livre['isbn'] ?? ''); ?>" required>

            <label for="price">Prix :</label>
            <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($livre['price'] ?? ''); ?>" step="0.01" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($livre['description'] ?? ''); ?></textarea>

            <label for="publisher">Éditeur :</label>
            <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($livre['publisher'] ?? ''); ?>" required>

            <label for="publish_date">Date de Publication :</label>
            <input type="date" id="publish_date" name="publish_date" value="<?php echo htmlspecialchars($livre['publish_date'] ?? ''); ?>" required>

            <label for="rating">Note :</label>
            <input type="number" id="rating" name="rating" value="<?php echo htmlspecialchars($livre['rating'] ?? ''); ?>" step="0.1" min="0" max="5" required>

            <label for="image_url">URL de l'Image :</label>
            <input type="url" id="image_url" name="image_url" value="<?php echo htmlspecialchars($livre['image_url'] ?? ''); ?>" required>

            <button type="submit">Enregistrer les modifications</button>
        </form>
        <a href="index.php" class="button-link">Retour à l'Index</a>
    </main>
</body>
</html>