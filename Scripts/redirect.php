<?php
// Récupération des variables du formulaire
$identifiant = isset($_POST['nom_ident']) ? $_POST['nom_ident'] : ''; // On récupère la valeur de l'input nom_ident du formulaire si elle existe sinon on initialise la variable à une chaîne vide.
$mdp = isset($_POST['nom_motpasse']) ? $_POST['nom_motpasse'] : ''; // On récupère la valeur de l'input nom_motpasse du formulaire si elle existe sinon on initialise la variable à une chaîne vide.

// CREATION D'UNE ID UNIQUE EN FONCTION DE L'HORODATAGE
$unique_id = uniqid('user_'); // On génère un identifiant unique pour l'utilisateur avec la fonction uniqid() en lui passant comme préfixe "user_".

include "./authentification_process.php"; // On inclut le fichier authentification_process.php qui contient les fonctions nécessaires à l'authentification.

// Vérification que l'identifiant et le mot de passe ne contiennent pas de caractères spéciaux
if (preg_match('/[\'"`]/', $identifiant)) {
	// Vérification de si l'identifiant contient des ' " ` Si c'est le cas, on redirige l'utilisateur vers la page d'inscription avec un message d'erreur.
 	header('Location: ../register.php?error=invalid');
 	exit; 
} else { 
	if (preg_match('/[\'"]/', $mdp)) { 	// Vérification de si l'identifiant contient des ' " ` Si c'est le cas, on redirige l'utilisateur vers la page d'inscription avec un message d'erreur.
		header('Location: ../register.php?error=invalid');
		exit;
	} else {
	
	    // Chemin et décodage du fichier des utilisateurs (json)
		$decode = file_get_contents('../Donnees/utilisateurs.json'); // On lit le contenu du fichier utilisateurs.json et on le stocke dans la variable $decode.
		$json = json_decode($decode, true); // On décode le contenu du fichier json dans un tableau en utilisant la fonction json_decode() et on stocke ce tableau dans la variable $json.
		
		// Définition du profil associé aux variables
		$profil = 'inconnu'; // On initialise la variable profil à 'inconnu' si jamais aucun compte est trouvé à la fin du code.
		
		if ($_GET["a"] === "login") { // Si la requête viens de login.php et non de register.php
		
			foreach ($json as $id) { // On boucle sur chaque élément du tableau $json qui correspond à chaque utilisateur enregistré.
		
				// Vérifier si le nom correspond
				if ($id['identifiant'] === $identifiant && $id['mot_de_passe'] === $mdp) { // Si l'identifiant et le mot de passe correspondent à ceux d'un utilisateur enregistré, on récupère le profil de l'utilisateur et on modifie l'ID de l'utilisateur.
					$profil = $id['profil'];
					// Modifier l'ID de l'utilisateur
					$unique_id = $id['id'];
					setcookie("user_id", $unique_id, time()+60*60*24*3, '/'); // On crée un cookie qui contient l'identifiant unique de l'utilisateur pour le garder authentifier
					break;		
				}
			}
		
			// REDIRECTION EN FONCTION DU PROFIL
			switch ($profil) {
				case 'inconnu': // Si le profil est inconnu
					header('Location: ../login.php?error=bad_password'); // Redirection vers la page de connexion avec un message d'erreur
					exit;
				case 'gestionnaire': // Si le profil est gestionnaire
					header('Location: ../Pages/shop.php'); // Redirection vers la page du magasin
					exit;
				default: // Si le profil est autre (simple)
					header('Location: ../Pages/shop.php'); // Redirection vers la page du magasin (shop.php gèrera automatiquement si il doit avoir accès au bouton ajouter un produit)
					exit;
			}

		} else { // Si la requête viens de register.php et non de login.php

			// Boucle qui parcourt chaque utilisateur dans le fichier json
			foreach ($json as $id) {
				// Vérifie si le nom d'utilisateur existe déjà dans le fichier json
				if ($id['identifiant'] === $identifiant) {
				$profil = "known";
				}
			}

			// Si le nom d'utilistauer est déjà connu, redirection vers register.php avec l'erreur 'known'
			if ($profil == "known") {
				header('Location: ../register.php?error=known');
				exit;
			} else { // Si l'utilisateur n'est pas déjà connu
				
				// Création d'un cookie de durée 30 jours pour authentifier automatiquement la personne
				setcookie("user_id", $unique_id, time()+60*60*24*3,'/');
				
				register($identifiant,$mdp,$unique_id,$json); // Fonction permettant d'écrire l'ulisateur dans la base de donnée
				header('Location: ../Pages/shop.php'); // Redirection vers le magasin
    			exit; // Fin du code
			}
		}
	}
}
?>