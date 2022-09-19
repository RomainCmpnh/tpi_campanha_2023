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

// Récupère la production via l'id
$idProduction = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$allProduction = null;
$erreur = false;
if (isset($idProduction) && isset($idProduction) != null) {
    $allProduction = getAllTshirtsById($idProduction);
}
if ($alltshirts == null) {
    $erreur = true;
} else {
    // Récupère le model du t-shirt
    $model = getAllModelsById($alltshirts[0]["id_model"]);
    // Récupère la marque de la t-shirt
    $marque = getAllBrandsById($model[0]["id_brand"]);
    // Regarde s'il reste des t-shirts ou non
    $epuise = false;
    if ($alltshirts[0]["quantity"] < 1) {
        $messageQuantity = '<p style="color: rgb(255, 0, 0);">Non disponible</p>';
        $epuise = true;
    } else if ($alltshirts[0]["quantity"] < 5) {
        $messageQuantity = '<p style="color: rgb(255, 132, 0);">' . $alltshirts[0]["quantity"] . ' réstante.</p>';
    } else {
        $messageQuantity = '<p style="color: rgb(35,174,0);">Disponible</p>';
    }
}

$isAdd = false;
// Ajoute au panier
$ajoutPanier = filter_input(INPUT_POST, "add-panier", FILTER_SANITIZE_STRING);
if (isset($ajoutPanier) == 1) {
    if (isset($_SESSION["panier"])) {
        array_push($_SESSION["panier"], $idtshirt);
    } else {
        $_SESSION["panier"] = array($idtshirt);
    }
    $newQuantity = ($alltshirts[0]["quantity"])-1;
    updateQuantitytshirts($newQuantity, $idtshirt);
    $isAdd = true;
    $alltshirts = getAllTshirtsById($idtshirt);
    if ($alltshirts[0]["quantity"] < 1) {
        $messageQuantity = '<p style="color: rgb(255, 0, 0);">Non disponible</p>';
        $epuise = true;
    } else if ($alltshirts[0]["quantity"] < 5) {
        $messageQuantity = '<p style="color: rgb(255, 132, 0);">' . $alltshirts[0]["quantity"] . ' réstante.</p>';
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
                                    <div class="sp-wrap"><a href="my-images/product/cap.jpg"><img class="img-fluid d-block mx-auto" src="my-images/product/cap.jpg"></a><a href="my-images/product/cap.jpg"><img class="img-fluid d-block mx-auto" src="my-images/product/cap.jpg"></a><a href="my-images/product/cap.jpg"><img class="img-fluid d-block mx-auto" src="my-images/product/cap.jpg"></a></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3>Titre production</h3>
                                    <div class="rating"><span class="badge badge-primary" style="background: rgb(94,88,88);padding: 6px 4.8px;margin: 2px;">Tague 1</span><span class="badge badge-primary" style="background: rgb(94,88,88);padding: 6px 4.8px;margin: 2px;">Tague 2</span><span class="badge badge-primary" style="background: rgb(94,88,88);padding: 6px 4.8px;margin: 2px;">Tague 3</span></div>
                                    <div class="price">
                                        <h3>Lieu</h3>
                                        <h3>Date</h3>
                                    </div>
                                    <div class="summary">
                                        <p>Voici la description de la production</p>
                                    </div>
                                </div>
                                <div class="filter-item"><a href="edit-production.php"><button class="btn btn-warning" type="button" style="background: rgb(255,226,76);border-color: rgb(255,226,76);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;">Modifier production</button></a></div>
                                <div class="filter-item"><a href=""><button class="btn btn-warning" type="button" style="background: rgb(255,19,0);border-color: rgb(255,19,0);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;">Supprimer production</button></a></div>

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