<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>I & Wear - Shop</title>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="shortcut icon" href="" type="img/logo.png">
  <link rel="stylesheet" href="/css/index.css">  
</head>

<body>


<nav>
  <?php 
include "../Scripts/authentification_process.php";

$cookie_result = request($_COOKIE["user_id"]);

if ($cookie_result[0] == False) {
  echo '<a href="../login.php">Se connecter</a>';
} else {
  echo "
  <a href=\"profil.php\"><img class=\"img_logo\" src=\"../images/logo_profil.png\">Votre profil</a>
  ";
  if ($cookie_result[1] == True) {
    echo '<a href="add.php">Ajouter un article</a>';
  } 
}
?> 
  <div class="recherche_input">
    <input type="text" maxlength="20" placeholder="Vous cherchez un produit ?" autocomplete=off name="text" class="input">
  </div>
</nav>

  
  
  <div class="div_page">
   
  <div class="title">
<h1>Bienvenue sur I & Wear</h1>
</div>

<script>
 const searchButton = document.querySelector('.input');
      searchButton.addEventListener('keyup', search);

      function search() {
        const searchInput = document.querySelector('.input');
        const searchTerm = searchInput.value.toLowerCase();
        const divs = document.querySelectorAll('.card');
        for (const div of divs) {
          const name = div.querySelector('.nom_produit').textContent.toLowerCase();
          if (name.includes(searchTerm)) {
            div.style.display = 'block';
          } else {
            div.style.display = 'none';
          }
        }
      }

      const cards = document.querySelectorAll('.card');
  </script>

  <div class="div_produits">
  <?php
  include "../Scripts/generate_html.php";
  create_shop("Disney")
  ?>
  </div>


  </div>
</div>
</body>

</html>