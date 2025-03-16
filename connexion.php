<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style4.css">
    <title>Connexion - Fnac</title>
</head>

<body>
    <header>
        <div class="header-container">
            <h1>Connexion à votre compte</h1>
            <nav>
                <a href="index_client.php" class="btn-back">Retour</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="login-form">
            <h2>Veuillez vous connecter</h2>

            <!-- Afficher un message d'erreur si la connexion a échoué -->
            <?php if (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
                <p style="color: red; font-weight: bold;">Identifiant ou mot de passe incorrect. Veuillez réessayer.</p>
            <?php endif; ?>

            <form action="traitement_connexion.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Se connecter</button>
            </form>

            <!-- Ajout d'un bouton pour l'inscription -->
            <p>Pas encore de compte ? <a href="inscription.php" class="btn-inscription">S'inscrire</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Fnac. Tous droits réservés.</p>
    </footer>
</body>

</html>
