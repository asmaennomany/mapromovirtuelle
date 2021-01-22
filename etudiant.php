<?php
  include("connexion.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ma promo virtuelle</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/stylish-portfolio.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <a class="menu-toggle rounded" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand">
        <a class="js-scroll-trigger" href="#page-top">Ma Promo Virtuelle</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#page-top">Accueil</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#about">A propos</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="profiles.php">Profiles</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="login.php">Se connecter</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#creer">Créer un compte étudiant</a>
      </li>
    </ul>
  </nav>

  <!-- Header -->
  <header class="masthead d-flex">
    <div class="container text-center my-auto">
      <h1 class="mb-1">Ma promo virtuelle</h1>
      <h3 class="mb-5">
        <em>Trouver votre stage facilement!</em>
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">En savoir plus</a>
    </div>
    <div class="overlay"></div>
  </header>

  <!-- About -->
  <section class="content-section bg-light" id="about">
    <div class="container text-center">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <h2>MaPromoVirtuelle est une plateforme qui rassemble les CVs des L3 Miage.</h2>
          <p class="lead mb-5">Créez un compte et remplissez votre CV afin de l'ajouter à la base de données des candidats et ainsi démontrer votre potentiel aux employeurs.</p>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="#creer">Créer un compte étudiant</a><br><br>
          <a class="btn btn-dark btn-xl js-scroll-trigger" href="login.php">Se connecter</a>
        </div>
      </div>
    </div>
  </section>


  <!-- Contact-->
        <section class="content-section bg-primary text-white" id="creer">
            <div class="container text-center">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Créer un compte étudiant</h2><br><br>
                </div>
                <form id="contactForm" name="sentMessage" novalidate="novalidate" action="traitement_creation.php" method="post" enctype="multipart/form-data">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" type="text" name="login" placeholder="Login *" required="required" data-validation-required-message="Veuillez saisir votre login." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" name="passe" placeholder="Mot de passe *" required="required" data-validation-required-message="Veuillez saisir votre mot de passe." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" name="nom" required="required" type="text" placeholder="Nom *" data-validation-required-message="Veuillez saisir votre nom."  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" name="prenom" placeholder="Prénom *" required="required" type="text" data-validation-required-message="Veuillez saisir votre prénom."  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <input class="form-control" name="post" placeholder="Post *" required="required" type="text" data-validation-required-message="Veuillez saisir votre post."  />
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="form-group mb-md-0">
                                <input class="form-control" name="date" placeholder="Date de naissance *" required="required" type="date" data-validation-required-message="Veuillez saisir votre date de naissance."  />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <select class="form-control" name="ville" required="required">
                                    <?php 
                                        
                                        $request = $PDO->prepare("SELECT * FROM ville");
                                        $request->execute();

                                        while ($list = $request->fetch(PDO::FETCH_ASSOC)) {
                                          echo '<option value='.$list['id_ville'].'>';
                                          echo $list['lib_ville'];
                                          echo '</option>';
                                        }
                                    ?>
                                </select>
                                <p class="help-block text-danger"></p>
                            </div>
                              <div class="form-group mb-md-0">
                                <input class="form-control" name="email" placeholder="Email *" required="required" type="email" data-validation-required-message="Veuillez saisir votre Email."  />
                                <p class="help-block text-danger"></p>
                            </div>
                            Photo :
                            <div class="form-group mb-md-0">
                                <input class="form-control-file" name="fichier" class="form-control-file" required="required" type="file" data-validation-required-message="Veuillez choisir une photo."/>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-xl btn-dark" id="sendMessageButton" type="submit" name="sub">Confirmer</button>
                    </div>
                </form>
            </div>
        </section>

  <!-- Footer -->
  <footer class="footer text-center">
    <div class="container">
      <ul class="list-inline mb-5">
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="https://www.facebook.com/">
            <i class="icon-social-facebook"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white mr-3" href="https://twitter.com/?lang=fr">
            <i class="icon-social-twitter"></i>
          </a>
        </li>
        <li class="list-inline-item">
          <a class="social-link rounded-circle text-white" href="https://github.com/asmaennomany/mapromovirtuelle">
            <i class="icon-social-github"></i>
          </a>
        </li>
      </ul>
      <p class="text-muted small mb-0">Copyright &copy; Ma Promo Virtuelle &middot; 2021</p>
    </div>
  </footer>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/stylish-portfolio.min.js"></script>

</body>

</html>