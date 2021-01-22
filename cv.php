<?php
	include("connexion.php");
	$id_user=$_GET['id_user'];

  $request = $PDO->prepare("SELECT * FROM user WHERE id_user= :id_user");
  $request->bindValue(":id_user",$id_user);
  $request->execute();
  $data = $request->fetch(PDO::FETCH_ASSOC);
  

  $login=$data['login'];
  $nom=$data['nom'];
  $prenom=$data['prenom'];
  $photo=$data['photo'];
  $post=$data['post'];
  $email=$data['email'];

  


		
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

  <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- W3S template -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

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
        <a class="js-scroll-trigger" href="profiles.php#portfolio">Profiles</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="#"></a>
      </li>
    </ul>
  </nav>


  <!-- Header -->
  <header class="masthead d-flex">
    <div class="container text-center my-auto">

      <!-- About Start -->
                <div class="about" id="about">
                    <div class="content-inner">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-5">
                            	<?php echo "<img src=\"photo/$photo\" alt=\"ma photo\" height=250 width=250/>"; ?>
                              
                            </div>
                            <div class="col-md-6 col-lg-7">
                            	<?php echo "<h2> $prenom $nom </h2>"?>
                              <?php echo "<h6><i> $post <i></h6>"?>
                              <?php echo "<a href=\"mailto:$email\" class=\"fa fa-envelope icon\">Contacter $prenom<a>"?>
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
                <!-- About End -->

      <!-- Education start-->
      <div class="education" id="education">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>Formation</h2>
                        </div>
                        <div class="row align-items-center">
                        	
                        	<?php
              								$request = $PDO->prepare("SELECT * FROM user, formation WHERE login= :login AND user.id_user=formation.id_user");
                              $request->bindValue(":login",$login);
                              $request->execute();

                              while($data = $request->fetch(PDO::FETCH_ASSOC))
              									{
              										$periode=$data['periode_formation'];
              										$designation=$data['libelle_formation'];
              										$description=$data['description_formation'];
              										$id_formation=$data['id_formation'];
              										if($periode!="" and $designation!="" and $description!=""){
              												echo "<div class=\"col-md-6\">";
              												echo "<div class=\"edu-col\" >";
              												echo"<span>$periode</span>";
              												echo"<h3>$designation</h3>";
              												echo"<p>$description</p>";
              												echo "</div>";
              												echo "</div>";
              											}
              									}
							             ?>
							
                            
                        </div>
                    </div>
                </div>
        <!-- Education end-->



        <!-- Experience Start -->
                <div class="experience" id="experience">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>Expérience</h2>
                        </div>
                        <div class="row align-items-center">
                        	<?php
                        		$request = $PDO->prepare("SELECT * FROM user, experience WHERE login= :login AND user.id_user=experience.id_user");
                            $request->bindValue(":login",$login);
                            $request->execute();

                          
                            while($data = $request->fetch(PDO::FETCH_ASSOC))
            								{
            									$periode=$data['periode_experience'];
            									$libelle=$data['libelle_experience'];
            									$description=$data['description_experience'];
            									$entreprise=$data['entreprise_experience'];
            									$id_experience=$data['id_experience'];

            									if($periode!="" and $libelle!="" and $description!="" and $entreprise!="")
            									{
            										echo "<div class=\"col-md-6\">";
            										echo "<div class=\"exp-col\">";
            										echo"<span> $periode </span>";
            										echo"<h3>$entreprise</h3>";
            										echo"<h5>$libelle</h5>";
            										echo"<p>$description</p>";
            										echo "</div>";
            										echo "</div>";
            									}
            								}
                        	?>
                            
                        </div>
                    </div>
                </div>
                <!-- Experience end -->

                <!-- Langue start -->
                <div class="experience" id="experience">
                    <div class="content-inner">
                        <div class="content-header">
                            <h2>Langue</h2>
                        </div>
                        <div class="row align-items-center">
                        	<?php
                        		$request = $PDO->prepare("SELECT * FROM user, user_langue, langue WHERE login= :login AND user.id_user=user_langue.id_user AND user_langue.id_langue=langue.id_langue");
                            $request->bindValue(":login",$login);
                            $request->execute();

                            while($data = $request->fetch(PDO::FETCH_ASSOC))
            								{
            									$langue=$data['libelle_langue'];
            									$niveau=$data['niveau'];
            									$id_langue=$data['id_langue'];
            									if($langue!="" and $niveau!="")
            									{
            										echo "<div class=\"col-md-6\">";
            										echo "<div class=\"exp-col\">";
            										echo"<span></span>";
            										echo"<h3>$langue</h3>";
            										echo"<h4>$niveau</h4>";
            										echo "</div>";
            										echo "</div>";	
            									}
            								}
                        	?>
               		 	</div>
                	</div> 	
                	 
                <!-- Langue end --> 
    </div>

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

  </header>


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