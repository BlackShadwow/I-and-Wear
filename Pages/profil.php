
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I & Wear - Votre profil</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="shortcut icon" href="" type="img/logo.png">
  <link rel="stylesheet" href="/css/index.css">
</head>

<body>

<h1> Bienvenue sur votre profil ! </h1>


<form method="POST" action="../Scripts/logout.php">
  <button class="deconnexion_button" type="submit" name="logout">Déconnexion</button>
</form>



<?php 
include "../Scripts/authentification_process.php";

$cookie_result = request($_COOKIE["user_id"]);

if ($cookie_result[0] == False) {
  header('Location: ../login.php');    
}

$statut = "Simple utilisateur";

if ($cookie_result[1] == True) {
  $statut = "Administrateur";
}

  echo"
<h1>Voici vos données :</h1>

<p>Statut : $statut </p>
<p>Identifiant : $cookie_result[2]</p>
<p>Mot de passe : $cookie_result[3]</p>

";
?>
</body>

</html>

