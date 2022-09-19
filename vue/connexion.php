<?php
//******************/
// * Nom et prénom : CAMPANHA Romain
// * Date : 30 Septembre 2022
// * Version : 1.0
// * Fichier : connexion.php
// * Description : page de connexion, permet à l'utilisateur de se connecter a son compte si son compte existe
//**************** */
session_start();

include("../model/functions/utilisateurs_functions.php");

// Si l'utilisateur est déjà connecté, il est renvoyé sur la page d'accueil
if (isset($_SESSION["role"])) {
    header("Location: accueil.php");
}

// Récupération des données de connexion
$pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING);
$mdp = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$mdp = hash('sha256', $mdp);

$erreur = false;

// Essayes la connexion
if (isset($pseudo) != null && isset($mdp) != null) {
    $user = GetUserByPseudoAndPassword($pseudo, $mdp);
    if ($user != null) {
        try {
          
                $_SESSION["role"] = "user";
                $_SESSION["idUser"] = $user[0]["id"];
                header("Location: accueil.php");
            
           
        } catch (Exception $e) {
            $erreur = true;
            $txtErreur = "Merci de contacter un administrateur : " . $e;
        }
    } else {
        $erreur = true;
        $txtErreur = "le pseudo ou le mot de passe est incorrecte.";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Foto'class</title>
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
                    <li class="nav-item"><a class="nav-link active" href="inscription.php">Inscription</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="page login-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading">
                    <header></header>
                    <header></header>
                    <h1 style="font-size: 44px;font-family: Aclonica, sans-serif;color: rgb(2,128,255);">FOTO'CLASS</h1>
                    <p style="font-family: 'Roboto Slab', serif;font-size: 31px;color: rgb(0,0,0);text-align: center;margin-bottom: 11px;">Connexion</p>
                    <p style="font-family: 'Roboto Slab', serif;">Connectez-vous à votre compte utilisateur.</p>
                </div>
                <form action="#" method="POST">
                        <?php if ($erreur == true) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Erreur!</strong> ' . $txtErreur . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                        }
                        ?>
                        <div class="form-group"><label for="pseudo">Pseudo</label><input class="form-control" type="text"  name="pseudo" id="pseudo"required <?php if($erreur==true){echo 'value="'.$pseudo.'"';} ?>></div>
                    <div class="form-group"><label for="password">Mot de passe</label><input class="form-control" type="password" id="password" required ></div><button class="btn btn-primary btn-block" type="submit" style="background: rgb(0,0,0);border-color: rgb(0,0,0);">Connexion</button>
                </form>
               
            </div>
        </section>
    </main>
    <footer class="page-footer dark">
        <div class="footer-copyright">
            <p><br>© 2022 Foto'class- All right reserved<br><br></p>
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