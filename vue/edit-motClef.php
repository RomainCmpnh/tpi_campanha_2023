<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 Septembre 2022
// * Version : 1.0
// * Fichier : edit-production.php
// * Description : Permet a l'utilisateur de modifer les donnée de sa production
//**************** */

session_start();

include("../model/functions/productions_functions.php");
include("../model/functions/motsclefs_functions.php");

// Si l'utilisateur n'est pas connecté, il est renvoyé sur la page de connexion
if (!isset($_SESSION["role"])) {
    header("Location: connexion.php");
}



// Récupération des données du mot clé
$motClefId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

$libelle = filter_input(INPUT_POST, "libelle", FILTER_SANITIZE_STRING);

// Modification de a production
$succes=0;
if($libelle != null){

    $motClef = getMotClefId($motClefId);
    $motClef = $motClef[0]["id"];

    updateMotClef($motClefId, $libelle);
  
    $libelleValue = $libelle;
    $succes=1;
    
}
else{
   $ancMotClef = getMotClefId($motClefId);
   $libelleValue = $ancMotClef[0]["libelle"];
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
                <div class="block-heading"></div>
                <p style="font-family: 'Roboto Slab', serif;font-size: 31px;color: rgb(0,0,0);text-align: center;margin-bottom: 11px;">Modification mot clef</p>
                <form action="#" method="POST">
                <?php
                            if($succes==1){ 
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Succès!</strong> La modification a été sauvegardée.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>';
                            }
                        ?>
                    <div class="form-group"><label for="name">mot clef</label><input class="form-control" type="text" id="libelle" name="libelle" value=<?php echo '"'.$libelleValue.'"'; ?>></div>
                    <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgb(0,0,0);">Modifier</button></div>
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