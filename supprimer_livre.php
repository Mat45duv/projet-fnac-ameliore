<?php
session_start();

// Vérifier si l'utilisateur est connecté (si nécessaire)
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index_client.php");
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'livres';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}

// Supprimer un livre si une requête a été envoyée
if (isset($_GET['delete'])) {
    $bookId = $_GET['delete'];

    // Préparer et exécuter la requête pour supprimer le livre
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->execute(['id' => $bookId]);

    // Redirection après la suppression
    header("Location: supprimer_livre.php");
    exit;
}

// Récupérer la liste des livres
$stmt = $pdo->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Livre</title>
    <link rel="stylesheet" href="css/style8.css">
</head>
<body>
    <header>
        <h1>Supprimer un Livre</h1>
        <a href="index_client.php">Retour à la page d'accueil</a>
    </header>

    <main>
        <h2>Liste des livres</h2>
        <?php if ($books): ?>
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Auteur</th>
                        <th>ISBN</th>
                        <th>Prix</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($book['title']); ?></td>
                            <td><?php echo htmlspecialchars($book['author']); ?></td>
                            <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                            <td><?php echo number_format($book['price'], 2, ',', ' ') . ' €'; ?></td>
                            <td>
                                <a href="supprimer_livre.php?delete=<?php echo $book['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun livre à afficher.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2025 Votre Librairie</p>
    </footer>
</body>
</html>
