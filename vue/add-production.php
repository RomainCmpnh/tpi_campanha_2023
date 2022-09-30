<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 septembre 2022
// * Version : 1.0
// * Fichier : add-production.php
// * Description : page d'ajout d'une production
//**************** */

session_start();

include("../model/functions/productions_functions.php");
include("../model/functions/motsclefs_functions.php");

// Verification de l'accès
if(!isset($_SESSION["role"])){
    header("Location: connexion.php");
    exit;
}

// Si l'utilisateur n'est pas connecté, il est renvoyé sur la page de connexion
if (!isset($_SESSION["role"])) {
    header("Location: connexion.php");
}

// Recuperation des données d'une nouvelle production
$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, "date");
$idlieu = filter_input(INPUT_POST, "lieu");
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
$idmotsclefs = $_POST['motsclefs'];
$idUser = $_SESSION["idUser"];

$allLieux = getAllLieux();
$allTags = getAllTags();

// File upload path
$targetDir = "../uploads/";
$imgName = basename($_FILES["file"]["name"]);
$new_image_name = uniqid("IMG_",false);
$fileName = $new_image_name.".".$imgName;
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

$msg = 0;

// Ajout d'une nouvelle production
if($titre != null && $date != null && $fileName != null){
    $int_Lieu = (int) $idlieu;
    $allowTypes = array('jpg','png');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $lastid = addProduction($titre, $date, $description, $fileName , $int_Lieu, $idUser);
            if($idmotsclefs != null){
            foreach($idmotsclefs as $item){
                $int_MotCle = (int) $item;
                addMotsClefsToProduction($int_MotCle, $lastid[1]);
            }
        }
        header("Location: accueil.php?new=1");
            exit;
        }
        } else{
        $msg = 1;
    }

}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Foto'class</title>
    <link rel="stylesheet" href="../model/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Slab&amp;display=swap">
    <link rel="stylesheet" href="../model/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../model/assets/fonts/simple-line-icons.min.css">
    <link rel="stylesheet" href="../model/assets/css/Articles-Badges-images.css">
    <link rel="stylesheet" href="../model/assets/css/Bootstrap-Image-Uploader.css">
    <link rel="stylesheet" href="../model/assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../model/assets/css/smoothproducts.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar" style="color: rgb(15,121,227);background: rgb(255, 255, 255);">
        <div class="container"><a class="navbar-brand logo" href="#">Foto'class</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="accueil.php">accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="productions.php">productions</a></li>
                    <li class="nav-item"><a class="nav-link" href="motsClefs.php">Mots-clefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="deconnexion.php">deconnexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="faqUtilisateur.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <p style="font-family: 'Roboto Slab', serif;font-size: 35px;color: rgb(0,0,0);text-align: center;">Ajouter une production</p>
                </div>
                <?php
                            if($msg==1){
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Erreur!</strong> L\'image séléctionnée n\'a pas le bon format !
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                            }
                        ?>
                <form action="#" method="POST" enctype="multipart/form-data">
 
                    <div class="form-group"><label for="title">Titre*</label><input class="form-control" type="text" id="titre" name="titre" required=""></div>
                    <div class="form-group"><label for="date">Date*</label><input class="form-control" type="date" required="" id="date" name="date"></div>
                    <label for="lieu">Lieu</label><select class="form-control" style="margin-bottom: 9px;" name="lieu" id="lieu">
                        <optgroup label="Liste des lieux">
                            <?php 
                            foreach($allLieux as $item) {
                                echo '<option value="'. $item["id"] . '" selected="">' . $item["nom"] . ' </option>';
                                
                            }
                            ?>
                    
                        </optgroup>
                    </select>
                    <div class="form-group"><label for="description">Description</label><textarea class="form-control" id="description" name="description"></textarea></div>
                    <div class="form-group"><label for="mots clefs">Mots clefs</label>
                 
                    <select class="form-control d-xl-flex" style="margin-bottom: 9px;" multiple="" name="motsclefs[]" id="motsclefs">
                            <optgroup label="Liste de mots clefs">
                            <?php 
                            foreach($allTags as $item) {
                                echo '<option value="'. $item["id"] . '" >' . $item["libelle"] . ' </option>';
                            
                            }
                            ?>
                            </optgroup>
                        </select></div>
                    <div class="form-group"><label for="image">Image*</label><input class="form-control-file" type="file" name="file" required=""></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgb(0,0,0);border-color: rgb(0,0,0);" >Ajouter</button></div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p>© 2022 Foto'class - All right reserved</p>
        </div>
    </footer>
    <script src="../model/assets/js/jquery.min.js"></script>
    <script src="../model/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="../model/assets/js/smoothproducts.min.js"></script>
    <script src="../model/assets/js/theme.js"></script>
    <script src="../model/assets/js/Bootstrap-Image-Uploader.js"></script>
</body>

</html>