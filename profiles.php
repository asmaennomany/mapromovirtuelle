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
        <a class="js-scroll-trigger" href="index.php">Accueil</a>
      </li>

      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#portfolio">Profiles</a>
      </li>
    </ul>
  </nav>

  <!-- Header -->
  <header class="masthead d-flex">
    <div class="container text-center my-auto">
      <h1 class="mb-1">Ma promo virtuelle</h1>
      <h3 class="mb-5">
        <em>Découvrir la promotion!</em>
      </h3>
      <a class="btn btn-primary btn-xl js-scroll-trigger" href="#portfolio">L3 MIAGE</a>
    </div>
    <div class="overlay"></div>
  </header>

 
 <!-- Portfolio -->
  <section class="content-section" id="portfolio">
    <div class="container">
      <div class="content-section-heading text-center">
        <h2 class="mb-5">Profiles</h2>
      </div>
      <div class="row no-gutters">

        <?php

                $request = $PDO->prepare("SELECT * FROM user");
                $request->execute();

                while($data = $request->fetch(PDO::FETCH_ASSOC))
                  {
                    $nom=$data['nom'];
                    $prenom=$data['prenom'];
                    $photo=$data['photo'];
                    $id_user=$data['id_user'];
                    $post=$data['post'];
                    if($nom!="" and $prenom!="" and $photo!=""){
                        echo "<div class=\"col-lg-6\">";
                        echo "<a class=\"portfolio-item\" href=\"cv.php?id_user=".$id_user."\">";
                        echo "<div class=\"caption\">";
                        echo "<div class=\"caption-content\">";
                        echo "<div class=\"h2\">$prenom $nom</div>";
                        echo "<p class=\"mb-0\">$post</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "<img src=\"photo/$photo\" alt=\"photo\" class=\"img-fluid\"/>"; 
                        echo "</a>";
                        echo "</div>";
                      }
                  }
              ?>

      </div>
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
          <a class="social-link rounded-circle text-white" href="https://github.com/asmaennomany/mapromovirtuelle/tree/master">
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