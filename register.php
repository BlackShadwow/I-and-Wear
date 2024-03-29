<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I & Wear - Créer un compte</title>
    <!-- Lien vers la police Google Montserrat -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <!-- Icône du site -->
    <link rel="shortcut icon" href="" type="img/logo.png">
    <!-- Lien vers la feuille de style index.css -->
    <link rel="stylesheet" href="/css/index.css">
</head>

<body>
<div id="register">
        <form action="/Scripts/redirect.php?a=register" method="POST">
        <?php 
            /* Vérification de si la variable de requête GET 'error' est définie et a une valeur "known" ou "invalid".
            Si elle a la valeur "known", cela signifie qu'un utilisateur avec le même nom existe déjà et un message d'erreur est affiché. 
            Si elle a la valeur "invalid", cela signifie qu'un nom d'utilisateur ou un mot de passe contient des caractères invalides et un autre message d'erreur est affiché. */
            if ($_GET['error'] === "known") {
                echo "<h2 class=\"error\">Utilisateur déjà enregistré.</h2>";
            }
            if ($_GET['error'] === "invalid") {
                echo "<h2 class=\"error\">Caractère invalide : \" ' `</h2>";
            }
        ?>
            <!-- Les éléments de formulaire suivants sont définis pour saisir le nom d'utilisateur, le mot de passe et pour soumettre le formulaire -->
            <input type="text" id="ident" min="5" max="20" name="nom_ident" placeholder="Nom d'utilisateur"><br>
            <input type="password" id="motpasse" min="5" max="20" name="nom_motpasse" placeholder="Mot de passe"><br><br>
            <input type="submit" id="submit" value="Creer un compte">
        </form>
        <!-- Un lien est ajouté pour se connecter si l'utilisateur a déjà un compte -->
        <p class="switch_method">Vous avez déjà un compte ? <a href="login.php">Connecter vous !</a></p>
    </div>
</body>
</html>