<?php
session_start();

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

// Mettre à jour l'état de la commande à "Livré"
if (isset($_GET['mark_delivered']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $sql = "UPDATE orders SET status = 'Livré' WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Stocker le message dans la session
    $_SESSION['message'] = "La commande ID $order_id a été marquée comme livrée.";

    // Redirection pour éviter le rechargement de la page avec la même requête GET
    header("Location: recap_commande.php");
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
    <link rel="stylesheet" href="css/style10.css"> <!-- Vous pouvez ajouter un fichier CSS pour améliorer le style -->
</head>
<body>
    
    <h1>Récapitulatif des Commandes</h1>
    
    <!-- Afficher un message après la mise à jour -->
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p style='color: green;'>" . $_SESSION['message'] . "</p>";
        unset($_SESSION['message']); // Supprimer le message après l'affichage
    }
    ?>
    
    <!-- Table des commandes -->
    <table border="1">
        <thead>
            <tr>
                <th>ID de la commande</th>
                <th>Nom du client</th>
                <th>Total (€)</th>
                <th>Date de la commande</th>
                <th>Status</th>
                <th>Actions</th>
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
                    echo "<td>" . htmlspecialchars($order['status']) . "</td>";
                    echo "<td>";
                    if ($order['status'] !== 'Livré') {
                        echo "<a href='?mark_delivered=1&order_id=" . $order['order_id'] . "'><button>Livré</button></a>";
                    } else {
                        echo "<span>Livré</span>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Aucune commande trouvée</td></tr>";
            }
            ?>
        </tbody>
    </table>
<!-- Bouton Retour à l'accueil -->
<div style="text-align: center; margin-top: 20px;">
    <a href="index.php"><button>Retour à l'accueil</button></a>
</div>

</body>
</html>
