<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I & Wear - Se connecter</title>
    <!-- Lien vers la police Google Montserrat -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!-- Icône du site -->
    <link rel="shortcut icon" href="" type="img/logo.png">
    <!-- Lien vers la feuille de style index.css -->
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
    <!-- Div contenant le formulaire de connexion -->
    <div id="login">
        <?php 
        // Vérification de la présence d'une erreur dans le lien (retournée par redirect.php en cas de mauvais identifiant ou mot de passe)
        if (isset($_GET['error'])) {
            // Affichage du message d'erreur si le mot de passe ou l'identifiant sont incorrects
            echo "<h2 class=\"error\">Mauvais mot de passe ou identifiant inconnu !</h2>";
        }
        ?>
        <!-- Formulaire de connexion qui envoie les données au script de redirection (redirect.php) -->
        <form action="/Scripts/redirect.php?a=login" method="POST">
            <!-- Champ pour le nom d'utilisateur -->
            <input type="text" id="ident" min="5" max="20" name="nom_ident" placeholder="Nom d'utilisateur"><br>
            <!-- Champ pour le mot de passe -->
            <input type="password" id="motpasse" min="5" max="20" name="nom_motpasse" placeholder="Mot de passe"><br><br>
            <!-- Bouton pour soumettre le formulaire -->
            <input type="submit" id="submit" value="Se connecter">
        </form>
        <!-- Lien pour créer un compte utilisateur -->
        <p class="switch_method">Vous n'avez pas de compte ? <a href="./register.php">Créer en un !</a></p>
    </div>
</body>
</html>
