<?php
session_start();

// Définir la langue par défaut si elle n'est pas définie
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';  // Langue par défaut en français
}

// Changer la langue si l'utilisateur le souhaite
if (isset($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
}

// Charger le fichier de langue approprié
include($_SESSION['lang'] . '.php');

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

// Traitement du formulaire de recherche
$searchQuery = '';
if (isset($_POST['search'])) {
    $searchQuery = $_POST['search'];
}

// Préparer la requête SQL pour la recherche
$sql = "SELECT * FROM books WHERE title LIKE :searchQuery OR author LIKE :searchQuery OR isbn LIKE :searchQuery OR price LIKE :searchQuery";
$stmt = $pdo->prepare($sql);
$stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ajouter un livre au panier
if (isset($_POST['add_to_cart'])) {
    $bookId = $_POST['book_id'];
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
    $stmt->execute(['id' => $bookId]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    // Ajouter le livre dans le panier (dans la session)
    $_SESSION['cart'][] = $book;
}

// Supprimer un livre du panier
if (isset($_POST['remove_from_cart'])) {
    $bookId = $_POST['book_id'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $bookId) {
            unset($_SESSION['cart'][$key]);
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index_client.php");
    exit;
}

// Sélectionner un livre au hasard pour la recommandation du jour
$stmt = $pdo->prepare("SELECT * FROM books ORDER BY RAND() LIMIT 1");
$stmt->execute();
$recommendedBook = $stmt->fetch(PDO::FETCH_ASSOC);

// Gérer l'ajout de la note pour un livre
if (isset($_POST['rate_book'])) {
    $bookId = $_POST['book_id'];
    $rating = $_POST['rating'];

    // Mettre à jour la note du livre dans la base de données
    $stmt = $pdo->prepare("UPDATE books SET rating = :rating WHERE id = :id");
    $stmt->execute(['rating' => $rating, 'id' => $bookId]);

    // Redirection pour éviter un rechargement multiple de la page avec le même formulaire
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Livres</title>
    <link rel="stylesheet" href="style5.css">
    <style>
        .book-details {
            margin-top: 10px;
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .recommended-book {
            margin-top: 30px;
            padding: 20px;
            background-color: #e0f7fa;
            border: 1px solid #b2ebf2;
            border-radius: 5px;
            text-align: center;
        }

        .recommended-book h2 {
            font-size: 1.5em;
            color: #00796b;
        }

        .recommended-book button {
            background-color: #4caf50;
        }

        .recommended-book button:hover {
            background-color: #388e3c;
        }

        .paypal-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0070ba;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .paypal-button:hover {
            background-color: #005b8a;
        }

        .book-card {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            text-align: center;
            width: 200px;
            display: inline-block;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .book-card img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .paypal-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0070ba;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1><?php echo $lang['search_placeholder']; ?></h1>
            <form method="POST">
                <input type="text" name="search" placeholder="<?php echo $lang['search_placeholder']; ?>" value="<?php echo htmlspecialchars($searchQuery); ?>">
                <button type="submit"><?php echo $lang['search_button']; ?></button>
            </form>

            <?php if (isset($_SESSION['username'])): ?>
                <form method="POST">
                    <button type="submit" name="logout"><?php echo $lang['logout_button']; ?></button>
                </form>
            <?php endif; ?>

            <!-- Formulaire pour changer de langue -->
            <form method="POST">
    <button type="submit" name="lang" value="fr">
        <img src="https://th.bing.com/th/id/R.925ec686f656d7fce41051a0c2947d88?rik=XFwadF0n7VCgfA&riu=http%3a%2f%2fwww.pixelstalk.net%2fwp-content%2fuploads%2f2016%2f07%2fFrench-Flag-HD-Image.png&ehk=z%2bbdEnHN4QAzLNlS06zhrRG0f5oKbwBA9NA%2bE%2bYJFxU%3d&risl=&pid=ImgRaw&r=0"  width="30" height="20">
    </button>
    <button type="submit" name="lang" value="en">
        <img src="https://th.bing.com/th/id/OIP.QFBLSTV0-0OCl3qXpRN-xgHaE8?rs=1&pid=ImgDetMain"  width="30" height="20">
    </button>
</form>

        </div>
    </header>

    <!-- Afficher le panier -->
    <div class="cart">
        <h2><?php echo $lang['cart_title']; ?></h2>
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $cartItem): ?>
                    <li>
                        <?php echo htmlspecialchars($cartItem['title']); ?> - <?php echo number_format($cartItem['price'], 2, ',', ' ') . ' €'; ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="book_id" value="<?php echo $cartItem['id']; ?>">
                            <button type="submit" name="remove_from_cart"><?php echo $lang['remove_from_cart']; ?></button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
            <p><?php echo $lang['total']; ?> : <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $total += $item['price'];
                }
                echo number_format($total, 2, ',', ' ') . ' €';
            ?></p>

            <!-- Formulaire pour PayPal -->
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="votre-email-paypal@example.com">
                <input type="hidden" name="item_name" value="Livres dans votre panier">
                <input type="hidden" name="amount" value="<?php echo $total; ?>">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="return" value="https://www.votresite.com/merci-pour-votre-commande.php">
                <input type="hidden" name="cancel_return" value="https://www.votresite.com/annulation-commande.php">
                <button type="submit" class="paypal-button"><?php echo $lang['pay_button']; ?></button>
            </form>

        <?php else: ?>
            <p><?php echo $lang['empty_cart']; ?></p>
        <?php endif; ?>
    </div>

    <!-- Afficher la recommandation du jour -->
    <div class="recommended-book">
        <h2><?php echo $lang['recommended_book']; ?></h2>
        <?php if ($recommendedBook): ?>
            <h3><?php echo htmlspecialchars($recommendedBook['title']); ?></h3>
            <p>Auteur : <?php echo htmlspecialchars($recommendedBook['author']); ?></p>
            <p>Prix : <?php echo number_format($recommendedBook['price'], 2, ',', ' ') . ' €'; ?></p>
            <form method="POST">
                <input type="hidden" name="book_id" value="<?php echo $recommendedBook['id']; ?>">
                <button type="submit" name="add_to_cart"><?php echo $lang['add_to_cart']; ?></button>
            </form>
        <?php else: ?>
            <p>Aucune recommandation disponible pour aujourd'hui.</p>
        <?php endif; ?>
    </div>

    <main>
        <div class="book-list">
            <?php if ($books): ?>
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <img src="<?php echo htmlspecialchars($book['image_url'] ?: 'placeholder.jpg'); ?>" alt="Image de <?php echo htmlspecialchars($book['title']); ?>">
                        <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p>Auteur : <?php echo htmlspecialchars($book['author']); ?></p>
                        <p>ISBN : <?php echo htmlspecialchars($book['isbn']); ?></p>
                        <p>Prix : <?php echo number_format($book['price'], 2, ',', ' ') . ' €'; ?></p>
                        
                        <!-- Afficher la note du livre -->
                        <?php if ($book['rating']): ?>
                            <p><strong><?php echo $lang['rating']; ?> :</strong> <?php echo number_format($book['rating'], 2); ?> / 5</p>
                        <?php else: ?>
                            <p><strong><?php echo $lang['rating']; ?> :</strong> <?php echo $lang['not_rated']; ?></p>
                        <?php endif; ?>

                        <!-- Formulaire pour noter le livre -->
                        <form method="POST">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <label for="rating"><?php echo $lang['rating']; ?> :</label>
                            <input type="number" name="rating" min="0" max="5" step="0.1" required>
                            <button type="submit" name="rate_book"><?php echo $lang['submit_rating']; ?></button>
                        </form>

                        <form method="POST">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit" name="add_to_cart"><?php echo $lang['add_to_cart']; ?></button>
                        </form>

                        <button onclick="toggleDetails(<?php echo $book['id']; ?>)">Voir les détails</button>
                        <div id="details-<?php echo $book['id']; ?>" class="book-details" style="display:none;">
                            <p><strong><?php echo $lang['description']; ?></strong> <?php echo htmlspecialchars($book['description'] ?: 'Aucune description disponible.'); ?></p>
                            <p><strong><?php echo $lang['publisher']; ?></strong> <?php echo htmlspecialchars($book['publisher'] ?: 'Non spécifié'); ?></p>
                            <p><strong><?php echo $lang['publish_date']; ?></strong> <?php echo htmlspecialchars($book['publish_date'] ?: 'Non spécifiée'); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p><?php echo $lang['no_books_found']; ?></p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <p><?php echo $lang['footer']; ?></p>
    </footer>

    <script>
        function toggleDetails(bookId) {
            var detailsDiv = document.getElementById('details-' + bookId);
            if (detailsDiv.style.display === 'none') {
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        }
    </script>
</body>
</html>
