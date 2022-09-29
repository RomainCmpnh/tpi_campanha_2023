<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30septembre 2022
// * Version : 1.0
// * Fichier : accueil.php
// * Description : Page d'acceuil : affichage des 10 productions les plus récente, recherche des productions et information sur Foto'class en bas de page. Permet a l'utilisateur d'ajouter une production
// * Description : Si l'utilisateur selectionne le bouton "voir" d'une production, il accède à la page détail de la production selectionnée
//**************** */

session_start();

include("../model/functions/productions_functions.php");

include("../model/functions/motsclefs_functions.php");



// Si l'utilisateur n'est pas connecté, il est renvoyé sur la page de connexion
if (!isset($_SESSION["role"])) {
    header("Location: connexion.php");
}

$result_page = 10; // Nombre de productions affichées que l'on veut sur cette page

$searchMotClef = 0; // Variable de gestion des mot clef par rapport à la recherche

$allProductionUser = getAllProductionMaxPageDateByUser($result_page, $_SESSION["idUser"]);

 // Recherche de productions
$rien = false;
$recherche = filter_input(INPUT_GET, "recherche", FILTER_SANITIZE_STRING);
if ($recherche != null || $recherche != "") {
    $allProductionUser =  getAllProductionUserBySearch($recherche, $_SESSION["idUser"]);
    $searchMotClef = 1;
    if ($allProductionUser == null) {
        $rien = true;
    }
}
//lorsque une production est ajoutée
$new = filter_input(INPUT_GET, "new", FILTER_SANITIZE_STRING);
if($new == 1){
    $confMsg = 1;
}

//supression d'une production
$del = filter_input(INPUT_GET, "del", FILTER_SANITIZE_STRING);
if($del==1){
    if(isset($_SESSION["role"])){
            $idToDelete = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
            delMotClefsProd($idToDelete);
            delProduction($idToDelete);
            header("Refresh:0; url=accueil.php");
            $confMsg = 1;
        
    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Foto'Class</title>
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
                    <li class="nav-item"><a class="nav-link active" href="accueil.php">accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="productions.php">productions</a></li>
                    <li class="nav-item"><a class="nav-link" href="motsClefs.php">Mots-clefs</a></li>
                    <li class="nav-item"><a class="nav-link" href="deconnexion.php">deconnexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="faqUtilisateur.php">F.A.Q</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="color: rgba(0,0,0,0.85);background: url(&quot;assets/img/my-images/banner.webp&quot;);">
            <div class="text">
                <h2 style="font-family: 'Roboto Slab', serif;height: 49px;width: 215.641px;font-size: 38px;">Foto'class</h2><button class="btn btn-outline-light btn-lg" type="button">Voir vos productions</button>
            </div>
        </section>
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <p style="font-family: 'Roboto Slab', serif;font-size: 32px;color: rgb(0,0,0);">Foto'class</p>
                    <p style="font-family: 'Roboto Slab', serif;">Voici vos fantastiques productions !</p>
                    <?php
                            if($confMsg==1){
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succès!</strong> L\'action a été éxécutée!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>';
                            }
                        ?>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="d-none d-md-block">
                                <div class="filters">
                                    <div class="filter-item">
                                    <form action="#" method="GET">
                                                    <h3>Rechercher</h3><input type="text" name="recherche"><input
                                                        type="submit" class="btn btn-primary" type="button"
                                                        style="margin-top: 3%;background: rgb(0,0,0);border-color: rgb(0,0,0);" value="Rechercher">
                                                </form>
                                    </div>
                                    <div class="filter-item"><a href="add-production.php"><button class="btn btn-warning" type="button" style="background: rgb(19,237,0);border-color: rgb(19,237,0);border-top-color: rgb(33,;border-right-color: 37,;border-bottom-color: 41);border-left-color: 37,;">Ajouter une production</button></a></div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-md-9">
                            <div class="products">
                                <div class="row no-gutters">
                                <?php
                                        if ($rien == true) {
                                            echo "<p>Nous n’avons trouvé aucun résultat pour <b>'" . $recherche . "'</b></p>";
                                        }
                                        foreach ($allProductionUser as $item) {
                                            // Récupère les mots clé de la production
                                            if($searchMotClef == 1){
                                                $allTagsbyProduction = getAllTagByProductionId($item["productions_id"]);
                                                $searchON = true; // variable de gestion servant a passer l'id a la page de détails
                                            }
                                            else{
                                            $allTagsbyProduction = getAllTagByProductionId($item["id"]);
                                            $searchON = false;
                                            }
                                            // Récupère le lieux de la production
                                            $lieu = getAlllieuxById($item["lieux_id"]);

                                            //url de l'image
                                            $imageURL = '../uploads/'.$item["filename"];

                                            // Affiche la production
                                            echo '<div class="col-12 col-md-6 col-lg-4">
                                            <div class="clean-product-item">
                                                <h3 style="font-size: 24px;"> '. $item["titre"] . '</h3>
                                                <p>' . $item["date"] . ' </p>
                                                <div class="image"><img class="img-fluid d-block mx-auto" src="' .  $imageURL . '" width="220" height="146"></a></div>
                                                
                                                ';  foreach($allTagsbyProduction as $tags){
                                              echo '<div><span class="badge badge-pill badge-primary mb-2"></span><span class="badge badge-primary" style="background: rgb(94,88,88);padding: 6px 4.8px;margin: 2px;">'. $tags["libelle"] . ' </span></div>';
                                                }

                                               echo '
                                                <div class="product-name"><a href="page-detail-production.php?id=' . $item["titre"] . '"></a></div>
                                                <div class="lieu">
                                                    <p>' . $lieu[0]["nom"] . '</p>
                                                </div>
                                                ';
                                                if($searchON == true)
                                                {
                                                echo '<a href="page-detail-production.php?id=' . $item["productions_id"] . '"><button class="btn btn-primary text-right float-right" type="button" style="margin-top: 3%;background: rgb(42,148,245);border-color: rgb(42,148,245);">Voir</button></a>';
                                                } elseif($searchON == false) {
                                                    echo '<a href="page-detail-production.php?id=' . $item["id"] . '"><button class="btn btn-primary text-right float-right" type="button" style="margin-top: 3%;background: rgb(42,148,245);border-color: rgb(42,148,245);">Voir</button></a>';
                                                }
                                           echo' </div>
                                        </div>';
                                            
                                        }
                                        ?>
                                    
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block clean-info dark">
            <div class="container">
                <div class="block-heading">
                    <p style="font-family: 'Roboto Slab', serif;font-size: 32px;color: rgb(0,0,0);">Informations</p>
                    <p>Qui sommes nous ?</p>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6"><img class="img-thumbnail" src="assets/img/my-images/home/who-are.jpg"></div>
                    <div class="col-md-6">
                        <h3>Foto'class</h3>
                        <div class="getting-started-info">
                            <p>Foto'class à été développé par de véritable photographe ! Tout a été pensé pour que l'interface utilisateur et l'efficacité du site soient intuitive , ergonomique, et impeccable !</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <p style="font-family: 'Roboto Slab', serif;font-size: 32px;color: rgb(0,0,0);">Nous vous garantissons</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5 feature-box">
                        <h4>La rapidité</h4>
                        <p>Notre site web est très performant et assure la disponibilité de vos productions</p>
                    </div>
                    <div class="col-md-5 feature-box">
                        <h4>Un service efficace</h4>
                        <p>Une question ? notre équipe sera heureuse de vous répondre et de vous aider</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="clean-block about-us"></section>
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