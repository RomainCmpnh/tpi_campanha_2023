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
?>