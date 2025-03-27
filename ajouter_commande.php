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

// Récupérer le montant total, soit du formulaire, soit d'une valeur par défaut
$total = isset($_POST['total']) ? $_POST['total'] : 100.50;  // Valeur par défaut si non envoyée

// Vérifier si le formulaire a été soumis
if (isset($_POST['ajouter_commande'])) {
    // Récupérer les autres données du formulaire
    $client_name = $_POST['client_name'];
    $order_date = $_POST['order_date'];  // La date est automatiquement fournie

    // Préparer la requête SQL pour insérer une nouvelle commande
    // Nous ne précisons pas la colonne order_id car elle doit s'auto-incrémenter
    $sql = "INSERT INTO orders (client_name, total, order_date, payment_status) VALUES (:client_name, :total, :order_date, 'pending')";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':client_name', $client_name);
    $stmt->bindParam(':total', $total);
    $stmt->bindParam(':order_date', $order_date);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Récupérer l'ID de la commande insérée
        $order_id = $pdo->lastInsertId();

        echo "<div class='message'>Commande ajoutée avec succès !</div>";

        // Ajouter le bouton de paiement qui redirige vers PayPal
        echo '<br><a href="https://www.paypal.com/signin?order_id=' . $order_id . '" target="_blank"><button class="btn btn-pay">Payer via PayPal</button></a>';
    } else {
        echo "<div class='error'>Erreur lors de l\'ajout de la commande.</div>";
    }
}
?>

<!-- Style CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        text-align: center;
    }

    .message, .error {
        font-size: 18px;
        color: #333;
        margin-top: 20px;
        padding: 10px;
        background-color: #e0ffe0;
        border: 1px solid #80c784;
        border-radius: 5px;
    }

    .error {
        background-color: #ffe0e0;
        border-color: #ff8080;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        margin-top: 20px;
        cursor: pointer;
    }

    .btn-pay {
        background-color: #FF5722;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
