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

$allLieux = getAllLieux();
$allTags = getAllTags();

// Récupération des données de la production
$productionId = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

$titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_STRING);
$lieu = filter_input(INPUT_POST, "lieu", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$motsClefs = $_POST['motsclefs'];

// File upload path
$targetDir = "../uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);


$ancProduction = getProductionById($productionId);

// Modification de a production
$succes=0;

if($titre != null && $date != null && $lieu != null && $description != null){

    //si il n'ya pas d'image, l'ancienne est conservée, sinon, la nouvelle est attribuée
    if($fileName == null){
        
        $fileNameAncValue = '../uploads/'.$ancProduction[0]["filename"];

        $production = getProductionById($productionId);
        $production = $production[0]["id"];
        
            
            updateProduction($productionId, $titre, $description , $fileNameAncValue, $date, $lieu );
        
            // si l'utilisateur modifie les mots clée, suprimme les liaisons, et le recrée
            if($motsClefs != null){
                delMotClefsProd($productionId);
                foreach($motsClefs as $item){
                    addMotsClefsToProduction($item["id"], $productionId);
                }
                
            } elseif($motsClefs == null){
                delMotClefsProd($productionId);
            }
        
          
            $titreValue = $titre;
            $dateValue = $date;
            $lieuValue = $lieu;
            $descriptionValue = $description;
            $motsClefsValue = $motsClefs;
            $fileNameValue =  $fileNameAncValue;
            header("Location: accueil.php?new=1");
            exit;
    }
    else {
    $allowTypes = array('jpg','png');
    
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
            $production = getProductionById($productionId);
            $production = $production[0]["id"];
        
            
            updateProduction($productionId, $titre, $description , $fileName, $date, $lieu );
        
            if($motsClefs != null){
                delMotClefsProd($productionId);
                foreach($motsClefs as $item){
                    addMotsClefsToProduction($item["id"], $productionId);
                }
                
            } elseif($motsClefs == null){
                delMotClefsProd($productionId);
            }
        
          
            $titreValue = $titre;
            $dateValue = $date;
            $lieuValue = $lieu;
            $descriptionValue = $description;
            $motsClefsValue = $motsClefs;
            $fileNameValue =  $fileName;
            $succes=1;
        }
    }
}
}
else{

   $titreValue = $ancProduction[0]["titre"];
   $dateValue = $ancProduction[0]["date"];
   $lieuValue = $ancProduction[0]["lieux_id"];
   $descriptionValue = $ancProduction[0]["description"];
   $fileNameValue = '../uploads/'.$ancProduction[0]["filename"];
   $ancMotsClefsValue = getAllMotsClefsById($productionId);
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
                <p style="font-family: 'Roboto Slab', serif;font-size: 31px;color: rgb(0,0,0);text-align: center;margin-bottom: 11px;">Modification</p>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group"><label for="titre">Titre</label><input class="form-control" type="text" id="titre" name="titre" required="" value=<?php echo '"'.$titreValue.'"'; ?>></div>
                <div class="form-group"><label for="date">Date</label><input class="form-control" type="date" required="" name="date" value=<?php echo '"'.$dateValue.'"'; ?>></div>
                <label for="lieu">Lieu</label><select class="form-control" style="margin-bottom: 9px;" name="lieu">
                    <optgroup label="Liste des lieux">
                    <?php 
                            
                            foreach($allLieux as $item) {
                                if($item["id"] == $lieuValue){
                                    echo '<option value="'. $item["id"] . '" selected="">' . $item["nom"] . ' </option>';
                                }else
                                echo '<option value="'. $item["id"] . '" >' . $item["nom"] . ' </option>';
                                
                            }
                            ?>
                    </optgroup>
                </select>
                <div class="form-group"><label for="description">Description</label><textarea class="form-control" id="description" name="description" ><?php echo $descriptionValue; ?></textarea></div>
                <div class="form-group"><label for="motsclefs">Mots clefs</label><select class="form-control d-xl-flex" style="margin-bottom: 9px;" multiple="" name="motsclefs[]" id="motsclefs">
                        <optgroup label="Liste des mots clefs">
                        <?php 
                              
                        //affichage de la liste des mots clefs de la production
                        if($ancMotsClefsValue != null)
                        {

                            foreach($allTags as $item) {
                                foreach($ancMotsClefsValue as $selected){ 
                                    if($selected["id"] == $item["id"]){
                                             echo '<option value="'. $selected["id"] . '" selected="" >' . $selected["libelle"] . ' </option>';
                                             unset($item);
                                             }
                                }
                                if($item["libelle"] == null)
                                {

                                }else{
                                echo '<option value="'. $item["id"] . '" >' . $item["libelle"] . ' </option>';
                                }
                            }

                            } else {
                                foreach($allTags as $item) {
                                    echo '<option value="'. $item["id"] . '" >' . $item["libelle"] . ' </option>';
                            }
                            }
                               
                            ?>
                        </optgroup>
                    </select></div>
                    <div class="form-group"><label for="image">Modifier l'image*</label><input class="form-control-file" type="file" name="file" value=<?php echo '"'.$fileNameValue.'"'; ?>></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgb(0,0,0);border-color: rgb(0,0,0);">Modifier</button></div>
            </form>
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