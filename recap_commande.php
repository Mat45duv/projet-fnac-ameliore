<?php
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

// Récupérer toutes les commandes
$sql = "SELECT * FROM orders ORDER BY order_date DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Récapitulatif des Commandes</title>
    <link rel="stylesheet" href="style.css"> <!-- Vous pouvez ajouter un fichier CSS pour améliorer le style -->
</head>
<body>
    <h1>Récapitulatif des Commandes</h1>
    
    <!-- Table des commandes -->
    <table border="1">
        <thead>
            <tr>
                <th>ID de la commande</th>
                <th>Nom du client</th>
                <th>Total (€)</th>
                <th>Date de la commande</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($order['order_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($order['client_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($order['total']) . "</td>";
                    echo "<td>" . htmlspecialchars($order['order_date']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucune commande trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
