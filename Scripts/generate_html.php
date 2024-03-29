<?php 


// create_shop() renvoie le code html de toute les cartes de produits.
function create_shop() {
    // On lit le contenu du fichier JSON contenant les informations sur les produits
    $decode = file_get_contents('../Donnees/produits.json');
    // On convertit le JSON en tableau PHP
    $json = json_decode($decode, true);

    // On parcourt le tableau de produits
    foreach ($json as $produit) {
        // On initialise les variables avec les informations du produit actuel
        $prix = $produit["prix"];
        $type = $produit["type"];
        $nom = $produit["nom"];

        // Si une des informations est manquante, on passe au produit suivant sans l'afficher dans le shop
        if (empty($nom) || empty($type) || empty($prix)) {
           continue;
         }

        // On transforme le nom du produit en minuscules, en remplaçant les espaces par des underscore
        $nom_lower = strtolower($type . " " . $nom);
        $nom_img = str_replace(' ', '_', $nom_lower);
        // On construit le chemin vers l'image correspondante
        $chemin_img = '../images/produits/' . $nom_img . '.webp';

        // On affiche les informations du produit actuel sous forme de carte HTML
        echo "<div class=\"card\"><div class=\"container_image\"><img class=\"image\" src=\"$chemin_img\"></div><h2 class=\"nom_produit\">$type $nom</h2><span class=\"price\">$prix €</span></div>";
}
}

// footer() renvoit le code html du footer pour toute les pages
function footer() {
    
}


?>