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

    $sql = "SELECT * FROM lieux ORDER BY id";
    
    $query = connect()->prepare($sql);

    $query->execute([
        
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
// Récupère tous les mots clefs
function getAllTags(){

    $sql = "SELECT * FROM motsclefs ORDER BY id";
    
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

    $sql = "SELECT * FROM motsclefs as mc
    JOIN productions_has_motsclefs as phm
    WHERE phm.productions_id = :id AND phm.motsclefs_id = mc.id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id' => $id,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


// Ajoute une Production
function addProduction($titre, $date, $description, $filename,$idLieu, $idUser){
    $sql = "INSERT INTO productions(utilisateurs_id, titre, description,filename, date , lieux_id) 
    VALUES (:id_user, :titre, :description, :filename , :date ,  :lieux_id)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id_user' => $idUser,
        ':titre' => $titre,
        ':description' => $description,
        ':filename' => $filename,
        ':date' => $date,
        ':lieux_id' => $idLieu,
    ]);
    $id = connect()->lastInsertId();
    return array($query->fetchAll(PDO::FETCH_ASSOC), $id);
}

// Modifie les données d'une production
function updateProduction($idProduction, $titre, $description, $filename, $date, $idLieu){

    $sql = "UPDATE productions SET titre=:titre, description=:description, date=:date,  filename = :filename, lieux_id = :lieux_id WHERE id = :production_id";

    $query = connect()->prepare($sql);

    $query->execute([
        ':production_id' => $idProduction,
        ':titre' => $titre,
        ':description' => $description,
        ':filename' => $filename,
        ':date' => $date,
        ':lieux_id' => $idLieu,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Ajoute un mot clef a une production
function addMotsClefsToProduction($idMotClef , $idProduction){
    $sql = "INSERT INTO productions_has_motsclefs(productions_id, motsclefs_id) VALUES (:production_id, :motsclefs_id)";

    $query = connect()->prepare($sql);

    $query->execute([
        ':motsclefs_id' => $idMotClef,
        ':production_id' => $idProduction,
        
    ]);
    return array($query->fetchAll(PDO::FETCH_ASSOC));
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



// Supprime une production
function delProduction($idProduction){
    $sql = "DELETE FROM  productions WHERE id = :id_production";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':id_production' => $idProduction,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Supprime une liaison entre un mot clef et une production
function delMotClefsProd($idProduction){
    $sql = "DELETE FROM  productions_has_motsclefs WHERE productions_id = :id_production";
    
    $query = connect()->prepare($sql);

    $query->execute([
        ':id_production' => $idProduction,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

// Recupere toutes les production ordonne par date selon le nombre demande et selon le user connecté
function getAllProductionMaxPageDateByUser($resultas_page, $idUser){

    $sql = "SELECT * FROM productions WHERE utilisateurs_id = :id_user ORDER BY id DESC LIMIT  :resultas_page";

    $query = connect()->prepare($sql);

    $query->execute([
        ':id_user' => $idUser,
        ':resultas_page' => $resultas_page,
    ]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

?>