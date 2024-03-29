<?php 
include "./authentification_process.php"; // inclusion du fichier d'authentification

$cookie_result = request($_COOKIE["user_id"]); // récupération de l'ID de l'utilisateur à partir des cookies et exécution d'une fonction de demande

if ($cookie_result[0] == False) { // si la demande a échoué
    header('Location: ../login.php'); // redirection vers la page de connexion
	exit; // arrêt de l'exécution du script
  } else { // sinon
    if ($cookie_result[1] == False) { // si l'utilisateur n'est pas un administrateur
        header('Location: ../Pages/shop.php'); // redirection vers la page de la boutique
		exit; // arrêt de l'exécution du script
    } 
  }

  $nom = isset($_POST['nom_article']) ? $_POST['nom_article'] : ''; // récupération du nom de l'article à partir des données POST
  $type = isset($_POST['type_vetement']) ? $_POST['type_vetement'] : ''; // récupération du type de vêtement à partir des données POST
  $prix = isset($_POST['prix_article']) ? $_POST['prix_article'] : ''; // récupération du prix de l'article à partir des données POST

    $decode = file_get_contents('../Donnees/produits.json'); // ouverture du fichier de données JSON
    $json = json_decode($decode, true); // décodage du contenu JSON en tant que tableau

  $newData = array(
    'type' => $type, // ajout du type de vêtement dans un nouveau tableau
    'nom' => $nom, // ajout du nom de l'article dans un nouveau tableau
    'prix' => $prix // ajout du prix de l'article dans un nouveau tableau
   );

   $json[] = $newData; // ajout du nouveau tableau dans ceux existants

   $jsonData = json_encode($json, JSON_PRETTY_PRINT); // conversion du tableau entier en JSON avec une indentation pour faciliter la lecture

   $file = fopen('../Donnees/produits.json', 'w'); // ouverture du fichier JSON en mode écriture
   fwrite($file, $jsonData); // écriture des données JSON dans le fichier
   fclose($file); // fermeture du fichier JSON

    header('Location: ../Pages/shop.php'); // redirection vers la page de la boutique
		exit; // arrêt de l'exécution du script
?>
