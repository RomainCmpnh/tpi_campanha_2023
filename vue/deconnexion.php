<?php
// Deconnexion
    session_start();
    unset($_SESSION["role"]);
    unset($_SESSION["idUser"]);
    header("Location: connexion.php");
    exit;
?>