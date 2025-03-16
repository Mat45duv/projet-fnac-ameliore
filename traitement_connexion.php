<?php
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

    // Vérifier si les informations de connexion sont envoyées par POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Requête pour récupérer l'utilisateur par son nom d'utilisateur
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $connection->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Vérifier si l'utilisateur existe et si le mot de passe est correct
        if ($user && $user['password'] === $password) {
            // Identifiants valides, démarrer la session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role']; // Stocke le rôle de l'utilisateur

            // Redirection vers la page d'accueil ou page d'administration
            if ($user['role'] === 'admin') {
                header("Location: index.php"); // Page admin
            } else {
                header("Location: index2.php"); // Page utilisateur normal
            }
            exit();
        } else {
            // Identifiants invalides, redirection vers la page de connexion avec un message d'erreur
            header("Location: connexion.php?error=true");
            exit();
        }
    }
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
?>
