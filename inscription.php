<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style4.css">
    <title>Inscription - Fnac</title>
</head>

<body>
    <header>
        <div class="header-container">
            <h1>Créer un compte</h1>
            <nav>
                <a href="index_client.php" class="btn-back">Retour</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="login-form">
            <h2>Inscrivez-vous pour accéder à votre compte</h2>

            <!-- Afficher un message d'erreur si l'inscription échoue -->
            <?php if (isset($_GET['error']) && $_GET['error'] === 'true'): ?>
                <p style="color: red; font-weight: bold;">Erreur lors de l'inscription. Veuillez réessayer.</p>
            <?php endif; ?>
            <!-- Afficher un message de succès si l'inscription réussit -->
<?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
    <p style="color: green; font-weight: bold;">Votre compte a été créé avec succès !</p>
<?php endif; ?>

            <form action="traitement_inscription.php" method="POST">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>

                <button type="submit">S'inscrire</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Fnac. Tous droits réservés.</p>
    </footer>
</body>

</html>
