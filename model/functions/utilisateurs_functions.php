<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30septembre 2022
// * Version : 1.0
// * Fichier : utilisateurs_functions.php
// * Description : Modèle contenant toute les fonctions liées aux utilisateurs
//**************** */
    // Inclus la connexion à la DB
    include_once("database.php");

    // Ajoute un utilisateur
    function addUser($pseudo, $mdp){

        $sql = "INSERT INTO utilisateurs (login, password) VALUES (:login, :password)";

        $query = connect()->prepare($sql);

        $query->execute([
            ':login' => $pseudo,
            ':password' => $mdp,
        ]);
        $id = connect()->lastInsertId();
        return array($query->fetchAll(PDO::FETCH_ASSOC), $id);
    }

    // Récupère l'utilisateur via son pseudo et password
    function GetUserByPseudoAndPassword($pseudo, $password){
        $sql = "SELECT * FROM utilisateurs WHERE login = :login AND password = :password";
    
        $query = connect()->prepare($sql);
    
        $query->execute([
            ':login' => $pseudo,
            ':password' => $password,
        ]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
?>