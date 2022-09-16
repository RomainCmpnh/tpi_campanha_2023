<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 Septembre 2022
// * Version : 1.0
// * Fichier : productions_functions.php
// * Description : Modèle contenant toute les fonctions liées aux productions
//**************** */

// Connexion à la DB
include_once("database.php");

// Récupère toutes les productions des plus récentes aux plus anciennes
function getAllProductionsOrderNewByUser($userid){

    $sql = "SELECT * FROM productions ORDER BY id_production DESC WHERE id_user = :id_user";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id_user' => $userid,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère toutes les productions qui correspondent à un des critères de recherches
function getAllProductionUserBySearch($search, $userid){

    $search = "%".$search."%";

    $sql = "SELECT * FROM productions  AS c JOIN lieux as l ON l.id_lieux = c.id_lieux  AS b JOIN motsclefs as m ON m.id_motsclefs = b.id_motsclefs WHERE id_user = :id_user AND  l.nom OR production.titre OR m.libelle LIKE :search";

    $query = connect()->prepare($sql);

    $query->execute([
        ':search' => $search,
        ':id_user' => $userid,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

?>