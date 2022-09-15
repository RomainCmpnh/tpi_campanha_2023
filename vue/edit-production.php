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
    <main class="page contact-us-page">
        <section class="clean-block clean-form dark">
            <div class="container">
                <div class="block-heading"></div>
                <p style="font-family: 'Roboto Slab', serif;font-size: 31px;color: rgb(0,0,0);text-align: center;margin-bottom: 11px;">Modification</p>
            </div>
            <form>
                <div class="form-group"><label for="title">Titre</label><input class="form-control" type="text" id="name" name="title" required=""></div>
                <div class="form-group"><label for="date">Date</label><input class="form-control" type="date" required="" name="date"></div><label for="lieu">Lieu</label><select class="form-control" style="margin-bottom: 9px;" name="lieu">
                    <optgroup label="This is a group">
                        <option value="12" selected="">This is item 1</option>
                        <option value="13">This is item 2</option>
                        <option value="14">This is item 3</option>
                    </optgroup>
                </select>
                <div class="form-group"><label for="description">Description</label><textarea class="form-control" id="message" name="description"></textarea></div>
                <div class="form-group"><label for="mots clefs">Mots clefs</label><select class="form-control d-xl-flex" style="margin-bottom: 9px;" multiple="" name="mots clefs">
                        <optgroup label="This is a group">
                            <option value="12" selected="">This is item 1</option>
                            <option value="13">This is item 2</option>
                            <option value="14">This is item 3</option>
                        </optgroup>
                    </select></div>
                <div class="form-group"><label for="image">Image</label><input class="form-control-file" type="file" required="" name="image"></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background: rgb(0,0,0);border-color: rgb(0,0,0);">Modifier</button></div>
            </form>
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