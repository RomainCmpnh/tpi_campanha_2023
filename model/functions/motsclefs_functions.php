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


?>