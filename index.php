<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style1.css">
    <title>Fnac front</title>
</head>

<body>
    <h1>Fnac: recherche dans le catalogue</h1>
    
    <form action="recherche.php" method="GET">
        <label for="choix">Rechercher par :</label>
        <select name="choix" id="choix" required>
            <option value="titre">Titre</option>
            <option value="auteur">Auteur</option>
            <option value="isbn">Numéro ISBN</option>
        </select>
        
        <label for="carac">Entrez une chaîne de caractères pour la recherche :</label>
        <input type="text" name="carac" placeholder="Entrez votre recherche" required>
        
        <button type="submit">Chercher</button>
    </form>
</body>

</html>





