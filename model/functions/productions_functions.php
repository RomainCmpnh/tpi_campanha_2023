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

// Récupère toutes les productions de l'utilisateur connecté, des plus récentes aux plus anciennes
function getAllProductionsOrderNewByUser($userid){

    $sql = "SELECT * FROM productions WHERE utilisateurs_id = :id_user ORDER BY id DESC";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':id_user' => $userid,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère tous les lieux
function getAllLieux(){

    $sql = "SELECT * FROM lieux";
    
    $query = connect()->prepare($sql);

    $query->execute([
        
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère tous les mots clefs
function getAllTags(){

    $sql = "SELECT * FROM motsclefs";
    
    $query = connect()->prepare($sql);

    $query->execute([
        
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère toutes les productions qui correspondent à un des critères de recherches
function getAllProductionUserBySearch($search, $userid){

    $search = "%".$search."%";

    
    $sql = "SELECT * FROM productions  AS c 
    INNER JOIN lieux as l ON l.id = c.lieux_id  
    LEFT JOIN productions_has_motsclefs as t ON c.id = t.productions_id 
    LEFT JOIN motsclefs as m ON t.motsclefs_id = m.id
    WHERE  utilisateurs_id = :idUser AND l.nom LIKE :search OR c.titre LIKE :search2 OR m.libelle LIKE :search3";

    $query = connect()->prepare($sql);

    $query->execute([
        ':idUser' => $userid,
        ':search' => $search,
        ':search2' => $search,
        ':search3' => $search,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère un lieu qui correspond à un certain ID
function getAllLieuxById($id){

    $sql = "SELECT * FROM lieux WHERE id = :id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id' => $id,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère les mots clefs qui correspondent à l'id de la production choisie
function getAllMotsClefsById($id){

    $sql = "SELECT * FROM productions_has_motsclefs 
    WHERE production_id = :id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id' => $id,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


// Ajoute une Production
function addProduction($titre, $date, $description, $idLieu, $idUser){
    $sql = "INSERT INTO productions(utilisateurs_id, titre, description, date ,filename, lieux_id) VALUES (:id_user, :titre, :description, :date , '' , :lieux_id)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id_user' => $idUser,
        ':titre' => $titre,
        ':description' => $description,
       // ':filename' => $filename,
        ':date' => $date,
        ':lieux_id' => $idLieu,
    ]);
    $id = connect()->lastInsertId();
    return array($query->fetchAll(PDO::FETCH_ASSOC), $id);
}

 // Récupère la production qui corréspond à un certain ID
 function getProductionById($id){

    $sql = "SELECT * FROM productions WHERE id = :id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id' => $id,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Ajoute une Production
function addMotsClefsToProduction($idMotClef , $idProduction){
    $sql = "INSERT INTO productions_has_motsclefs(productions_id, motsclefs_id) VALUES (:production_id, :motsclefs_id)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':motsclefs_id' => $idMotClef,
        ':production_id' => $idProduction,
        
    ]);
    return array($query->fetchAll(PDO::FETCH_ASSOC));
}


?>