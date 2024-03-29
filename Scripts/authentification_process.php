<?php 
/**
 * Vérification de si un compte est connecté et de si l'accès adminitrateur est autorisé
 *
 * résultat attendu :
 *   result = [bool,bool,string] 
 *   (Premier booléen pour si la personne est connecté, le deuxième si il à les permissions administrateur 
 *   et le string pour le nom d'utilisateur de la personne)
 *
 */
 
 function request($user_cookie) {
    
    // Chemin et décodage du fichier des utilisateurs (json)
	$decode = file_get_contents('../Donnees/utilisateurs.json');
	$json = json_decode($decode, true);

    //Application des variables par défaut
    $connected = False;
    $admin = False;
    $user_name = "";

    //Recherche de l'id de l'utilisateur dans la base de données
    foreach ($json as $it) { // Pour chaque iteration du json
        if ($it["id"] == $user_cookie) { // Si l'id contenu dans le cookie correspont à un dans la base de données
            $connected = True; // L'utilisateur est connecté à un compte existant
            if ($it["profil"] == "gestionnaire") { // Si l'utilisateur est connecté à un compte avec les permissions gestionnaire
                $admin = True;
            }
            $user_name = $it["identifiant"]; // $user_name = Nom d'utilisateur du compte connecté
            $mdp = $it["mot_de_passe"];
        }
    }
    
    // Retourne les informations de l'utilisateur : s'il est connecté, s'il est un administrateur, et son nom d'utilisateur
    return [$connected, $admin, $user_name, $mdp];
} 

/**
 * Processus d'enregistrement du nouvel utilisateur dans la base de données 
 * + 
 * création du cookie permettant de le garder enregister
 */

function register($identifiant,$mdp,$unique_id,$json) {
    // Création d'un tableau pour le profil du nouvel utilisateur
    $newData = array(
        'identifiant' => $identifiant,
        'mot_de_passe' => $mdp,
        'profil' => 'simple',
        'id' => $unique_id
      );
    $json[] = $newData;

    // Conversion du tableau en JSON
    $jsonData = json_encode($json, JSON_PRETTY_PRINT); 
    // JSON_PRETTY_PRINT = Code en plusieurs ligne et non en une seule

    // Ecriture des données dans le fichier utilisateurs.json
    $file = fopen('../Donnees/utilisateurs.json', 'w');
    fwrite($file, $jsonData);
    fclose($file);
}

?>