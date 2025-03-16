<?php
session_start();

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

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Vérifier si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // L'utilisateur existe déjà, rediriger avec une erreur
        header("Location: inscription.php?error=true");
        exit;
    } else {
        // Insérer le nouvel utilisateur dans la base de données
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword, 'email' => $email]);

        // Rediriger avec un message de succès
        header("Location: inscription.php?success=true");
        exit;
    }
}
?>
