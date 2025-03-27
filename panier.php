<?php
session_start();
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Votre panier est vide.";
    exit();
}

$dsn = 'mysql:host=localhost;dbname=livres;charset=utf8';
$utilisateur = 'root';
$motDePasse = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

$connection = new PDO($dsn, $utilisateur, $motDePasse, $options);

$cartItems = [];
foreach ($_SESSION['cart'] as $bookId) {
    $query = "SELECT * FROM books WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->execute([$bookId]);
    $cartItems[] = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Votre Panier</h1>
        <nav>
            <a href="index.php">Retour à la Bibliothèque</a>
        </nav>
    </header>

    <main>
        <h2>Livres dans votre panier</h2>
        <ul>
            <?php foreach ($cartItems as $item): ?>
                <li>
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p><strong>Auteur:</strong> <?php echo htmlspecialchars($item['author']); ?></p>
                    <p><strong>Prix:</strong> <?php echo number_format($item['price'], 2, ',', ' ') . ' €'; ?></p>
                    <a href="supprimer_panier.php?id=<?php echo $item['id']; ?>">Retirer</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </main>

    <footer>
        <p>&copy; 2025 Fnac. Tous droits réservés.</p>
    </footer>

</body>
</html>
