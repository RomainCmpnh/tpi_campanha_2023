<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 Septembre 2022
// * Version : 1.0
// * Fichier : motsclefs_functions.php
// * Description : Modèle contenant toute les fonctions liées aux motsclefs
//**************** */


function getAllTagByProductionId($id){

$sql = "SELECT * FROM motsclefs AS c JOIN  productions_has_motsclefs AS l ON l.motsclefs_id = c.id WHERE productions_id = :id_production  ORDER BY id DESC";

$query = connect()->prepare($sql);

$query->execute([
    ':id_production' => $id,
]);
return $query->fetchAll(PDO::FETCH_ASSOC);
}

function getAllMotsClefs(){

    $sql = "SELECT * FROM motsclefs ORDER BY id DESC";
    
    $query = connect()->prepare($sql);

    $query->execute([
        
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
function countMotsClefsOccurence($idMotClef){

    $sql = "SELECT COUNT (*) FROM productions_has_motsclefs WHERE motsclefs_id = :idMotsClefs";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':idMotsClefs' => $idMotClef,
    ]);
    
    return $query->fetchColumn();
}

// Ajoute un mot clef
function addMotClefs($libelle){
    $sql = "INSERT INTO motsclefs(libelle) VALUES (:libelle)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':libelle' => $libelle,
    ]);
    $id = connect()->lastInsertId();
    return array($query->fetchAll(PDO::FETCH_ASSOC), $id);
}

// Supprime un mot clef
function delMotClef($idMotClef){
    $sql = "DELETE FROM  motsclefs WHERE id = :id_motclef";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':id_motclef' => $idMotClef,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Supprime une liaison entre un mot clef et une production
function delMotClefInProd($idMotClef){
    $sql = "DELETE FROM  productions_has_motsclefs WHERE motsclefs_id = :id_motclef";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':id_motclef' => $idMotClef,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

 // Récupère le mot clef qui corréspond à un certain ID
 function getMotClefId($id){

    $sql = "SELECT * FROM motsclefs WHERE id = :id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id' => $id,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Modifie les données d'un mot clef
function updateMotClef($idMotClef, $libelle){

    $sql = "UPDATE motsclefs SET libelle=:libelle WHERE id = :motclef_id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':motclef_id' => $idMotClef,
        ':libelle' => $libelle,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>