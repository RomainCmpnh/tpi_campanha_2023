<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 Septembre 2022
// * Version : 1.0
// * Fichier : page-detail-produiction.php
// * Description : affiche les détails du produit séléctionner. Permet a l'utilisateur de supprimer la production, ou d'accéder a sa page de modification
//**************** */
session_start();

include("../model/functions/productions_functions.php");
include("../model/functions/motsclefs_functions.php");


// Si l'utilisateur n'est pas connecté, il est renvoyé sur la page de connexion
if (!isset($_SESSION["role"])) {
    header("Location: connexion.php");
}

// Récupère la production via l'id
$idProduction = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$production = null;
$erreur = false;


if (isset($idProduction) && isset($idProduction) != null) {
    $production = getProductionById($idProduction);
}
if ($production == null) {
    $erreur = true;
} else {
    // Récupère le lieu de la production
    $lieu = getAllLieuxById($production[0]["lieux_id"]);
    
    // Récupère la liste des mots clefs de la production
    $allMotsClefs = getAllTagByProductionId($idProduction);
    //récupération de l'image
    $imageURL = '../uploads/'.$production[0]["filename"];
    
   
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
                    <li class="nav-item"><a class="nav-link" href="motsClefs.php">Mots-clefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="deconnexion.php">deconnexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="faqUtilisateur.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">
                <div class="block-heading"></div>
                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                
                                        <a href="<?php echo $imageURL ?>"><img class="img-fluid d-block mx-auto" src="<?php echo $imageURL ?>"></a>                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3><?php echo $production[0]["titre"]?></h3>
                                    <?php 
                                    foreach($allMotsClefs as $tags){
                                        echo '<div><span class="badge badge-pill badge-primary mb-2"></span><span class="badge badge-primary" style="background: rgb(94,88,88);padding: 6px 4.8px;margin: 2px;">'. $tags["libelle"] . ' </span></div>';
                                          }
                                    ?>
                                    <div class="price">
                                        <h3><?php echo $lieu[0]["nom"]?></h3>
                                        <h3><?php echo $production[0]["date"]?></h3>
                                    </div>
                                    <div class="summary">
                                        <p><?php echo $production[0]["description"]?></p>
                                    </div>
                                </div>
                                <form action="page-detail-production.php?id=<?php echo $idProduction; ?>" method="POST">
                                <?php echo '<div class="filter-item"><a href="edit-production.php?id='.$idProduction.'"><button class="btn btn-warning" type="button" style="background: rgb(255,226,76);border-color: rgb(255,226,76);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;">Modifier production</button></a></div>' ?>
                                <?php echo '<div class="filter-item"><a href="accueil.php?del=1&id='.$idProduction.'"><button class="btn btn-warning" type="button" style="background: rgb(255,19,0);border-color: rgb(255,19,0);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;">Supprimer production</button></a></div>' ?>
                                
                                </form>          
                            </div>
                            
                        </div>
                    </div>
                </div>
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