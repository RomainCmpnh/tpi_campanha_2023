<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30septembre 2022
// * Version : 1.0
// * Fichier : motsClefs.php
// * Description : Page d'affichage et de gestion des mots clé
//**************** */

session_start();
include("../model/functions/productions_functions.php");
include("../model/functions/motsclefs_functions.php");



// Si l'utilisateur n'est pas connecté, il est renvoyé sur la page de connexion
if (!isset($_SESSION["role"])) {
    header("Location: connexion.php");
}

// Recuperation des données d'un nouveau mot clef
$libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_STRING);

// Ajout d'une nouvelle production
if($libelle != null){
    addMotClefs($libelle);

}

//récuperation de la liste des mots clefs
$allMotClefs = getAllMotsClefs();

//supression d'un mot clef ainsi que les liaison avec les productions
$del = filter_input(INPUT_GET, "del", FILTER_SANITIZE_STRING);
if($del==1){
    if(isset($_SESSION["role"])){
            $idToDelete = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
            delMotClefInProd($idToDelete);
            delMotClef($idToDelete);
            header("Refresh:0; url=motsClefs.php");
          
        
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Foto'class</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="assets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Image-Uploader.css">
    <link rel="stylesheet" href="assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="color: rgb(15,121,227);background: rgb(255, 255, 255);">
        <div class="container"><a class="navbar-brand logo" href="#">Foto'class</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="accueil.php">accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="productions.php">productions</a></li>
                    <li class="nav-item"><a class="nav-link active" href="motsClefs.php">Mots-clefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="deconnexion.php">deconnexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="faqUtilisateur.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
    
            <div class="container">
            <form action="#" method="POST">
                <div class="block-heading">
                    <p style="font-family: 'Roboto Slab', serif;font-size: 31px;color: rgb(0,0,0);text-align: center;margin-bottom: 11px;">mots clefs</p><button class="btn btn-success" type="submit" name="libelle" style="margin-right: 7px;">Ajouter un mot clef</button><input type="text" name="libelle">

                </div>
            </form>
            <table class="table">
                <form action="#" method="POST">
                    <h3 class="title">Liste mots clefs - occurence totale a tous les utilisateurs</h3>
                    
                        
                    <?php 
                        foreach($allMotClefs as $item) {
                           $nb = countMotsClefsOccurence($item["id"]);
                            echo '<tr><td><div class="item"><span class=""><a href="edit-motClef.php?id='.$item["id"].'">
                           <i class="fa fa-pencil" style="color: rgb(255,153,0);"></i></a>&nbsp;&nbsp;</td>
                           <td> <a href="motsClefs.php?del=1&id='.$item["id"].'"">
                          <i class="fa fa-trash" style="color: var(--red);"></i></a></span></td>
                           <td> <p class="item-name">' . $item['libelle'] . "</td> <td>" . $nb .  " occurences" . '</td></p>
                        </div></tr>';
                        }
                        ?>
                    
                     
                       
                        
                
                </form>
                </table>  
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2022 Foto'class - All right reserved</p>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="assets/js/smoothproducts.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Bootstrap-Image-Uploader.js"></script>
</body>

</html>