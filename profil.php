<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: index_client.php");
    exit;
}

// Connexion à la base de données (adapté selon votre configuration)
$host = 'localhost'; // L'hôte de la base de données
$dbname = 'livres'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur
$password = ''; // Mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur introuvable.";
    exit;
}

// Récupérer les commandes basées sur le nom d'utilisateur (username)
$sql = "SELECT * FROM orders WHERE client_name = :client_name ORDER BY order_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['client_name' => $user['username']]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Mes Commandes</title>
    <link rel="stylesheet" href="css/style7.css"> <!-- Vous pouvez ajouter un fichier CSS pour améliorer le style -->
</head>
<body>
    <h1>Bienvenue, <?php echo htmlspecialchars($user['username']); ?> !</h1>
    <h2>Vos Commandes</h2>
    
    <!-- Table des commandes -->
    <table border="1">
        <thead>
            <tr>
                <th>ID de la commande</th>
                <th>Nom du client</th>
                <th>Total (€)</th>
                <th>Date de la commande</th>
                <th>Statut de paiement</th>
                <th>Statut</th> <!-- Changer "Statut de livraison" à "Statut" -->
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    echo "<tr>";
echo "<td>" . htmlspecialchars($order['order_id']) . "</td>";
echo "<td>" . htmlspecialchars($order['client_name']) . "</td>";
echo "<td>" . htmlspecialchars($order['total']) . " €</td>";
echo "<td>" . htmlspecialchars($order['order_date']) . "</td>";
echo "<td>" . htmlspecialchars($order['payment_status']) . "</td>";
echo "<td>" . htmlspecialchars($order['status']) . "</td>";
echo "</tr>";

                }
            } else {
                echo "<tr><td colspan='6'>Aucune commande trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="index2.php">Retour à l'accueil</a>
</body>
</html>
