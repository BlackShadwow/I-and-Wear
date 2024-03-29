
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I & Wear - Ajouter un produit</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="shortcut icon" href="" type="img/logo.png">
  <link rel="stylesheet" href="/css/index.css">
</head>

<body>

<?php 

// Inclure le fichier d'authentification
include "../Scripts/authentification_process.php";

// Obtenir le résultat du cookie d'utilisateur
$cookie_result = request($_COOKIE["user_id"]);

// Vérifier si l'utilisateur n'est pas connecté
if ($cookie_result[0] == False) {
    // Utilisateur non connecté donc : Rediriger l'utilisateur vers la page de connexion
    header('Location: ../login.php');
    exit;
} else {
    // Vérifier si l'utilisateur n'est pas un administrateur
    if ($cookie_result[1] == False) {
        // Utilisateur non administrateur donc : Rediriger l'utilisateur vers la page du magasin
        header('Location: ../Pages/shop.php');
        exit;
    } 
}

?> 
<!-- Formulaire pour ajouter un nouveau produit -->
<form action="../Scripts/add_product.php" method="POST" enctype="multipart/form-data">
  <input type="text" id="input_nom_article" name="nom_article" maxlength="12" placeholder="Nom de l'article"><br>
  <!-- Sélectionner le type de vêtement pour le produit -->
<label for="type_vetement">Type de vêtement :</label>
<select name="type_vetement" id="type_vetement">
<option value="T-shirt">T-shirt</option>
<option value="Chemise">Chemise</option>
<option value="Débardeur">Débardeur</option>
<option value="Blouse">Blouse</option>
<option value="Pull">Pull</option>
<option value="Sweat">Sweat</option>
<option value="Veste">Veste</option>
<option value="Jupe">Jupe</option>
<option value="Pantalon">Pantalon</option>
<option value="Short">Short</option>
<option value="Legging">Legging</option>
<option value="Maillot de bain">Maillot de bain</option>
<option value="Sous vêtement">Sous-vêtement</option>
<option value="Pyjama">Pyjama</option>
</select><br><br>

  <!-- Sélectionner le prix du produit -->
  <input type="range" id="slider" name="prix_article" min="1" max="1000" value="50">
  <p><span id="slider-value">50</span></p>
  <!-- Bouton pour soumettre le formulaire -->
  <input type="submit" id="submit" value="Ajouter le produit">
</form>
<script>
  const slider = document.getElementById("slider");
  const sliderValue = document.getElementById("slider-value");
  
  // Mettre à jour la valeur sélectionnée à chaque changement de valeur sur le curseur de sélection
  slider.addEventListener("input", function() {
    sliderValue.textContent = slider.value;
  });
</script>
</body>

</html>