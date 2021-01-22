<?php
session_start();

// ---------------- SECURISATION ----------------

if (!isset($_SESSION['login'])) {
    header('location: index.php');
  }


// ---------------- RECUPERATION USER ----------------

include("connexion.php");
$id_user=$_SESSION['id_user'];


// ---------------- SUPPRESSION D'UNE EXPERIENCE ----------------

if (isset($_GET['id_a_supprimer'])) {
  $id_experience=$_GET['id_a_supprimer'];

  $request = $PDO->prepare("DELETE FROM experience WHERE id_experience= :id_experience");
  $request->bindValue(":id_experience",$id_experience);
  $request->execute();

  header('location: moncv.php');
}


// ---------------- AJOUT DES DONNEES ----------------

if(isset($_POST['sub']) && $_POST['flag']==""){

  $periode=$_POST['periode'];
  $libelle=$_POST['libelle'];
  $description=$_POST['description'];
  $entreprise=$_POST['entreprise'];

  $request = $PDO->prepare("INSERT INTO experience VALUES(NULL,:id_user,:periode,:libelle,:description,:entreprise)");
  $request->bindValue(":id_user",$id_user);
  $request->bindValue(":periode",$periode);
  $request->bindValue(":libelle",$libelle);
  $request->bindValue(":description",$description);
  $request->bindValue(":entreprise",$entreprise);
  $request->execute();

  header('location: moncv.php');
}

// ---------------- MODIFICATION DES DONNEES ----------------

if (isset($_POST['flag']) && $_POST['flag']!="") {

  $_POST['flag']="";
  
  $periode=$_POST['periode'];
  $libelle=$_POST['libelle'];
  $description=$_POST['description'];
  $entreprise=$_POST['entreprise'];
  $id_experience=$_POST['idam'];

  $request = $PDO->prepare("UPDATE experience SET periode_experience=:periode, libelle_experience=:libelle, description_experience=:description, entreprise_experience=:entreprise WHERE id_experience=:id_experience");
  
  $request->bindValue(":periode",$periode);
  $request->bindValue(":libelle",$libelle);
  $request->bindValue(":description",$description);
  $request->bindValue(":id_experience",$id_experience);
  $request->bindValue(":entreprise",$entreprise);

  $request->execute();

  header('location: moncv.php');
}

// ---------------- RECUPERATION DES INFOS | CAS DE MODIFICATION----------------

//par defaut
$periode_m=$designation_m=$description_m=$entreprise_m=$flag_m="";

//DB
if (isset($_GET['id_experience'])) {

  $id_experience=$_GET['id_experience'];
  $flag_m="vrai";

  $request = $PDO->prepare("SELECT * FROM experience WHERE id_experience= :id_experience");
  
  $request->bindValue(":id_experience",$id_experience);
  
  $request->execute();

  $data = $request->fetch(PDO::FETCH_ASSOC);

  $periode_m=$data['periode_experience'];
  $designation_m=$data['libelle_experience'];
  $description_m=$data['description_experience'];
  $entreprise_m=$data['entreprise_experience'];
}


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

  <!-- Style -->
  <style type="text/css">

  </style>

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
        <a class="js-scroll-trigger" href="moncv.php">Mon CV</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="ajouter_formation.php">Ajouter une formatoin</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="ajouter_experience.php">Ajouter une éxperience</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="ajouter_langue.php">Ajouter une langue</a>
      </li>
      <li class="sidebar-nav-item">
        <a class="js-scroll-trigger" href="deconnexion.php">Se déconnecter</a>
      </li>
    </ul>
  </nav>



  <header class="masthead d-flex">
    <div class="container text-center my-auto">
      <div class="text-center">
          <?php if (isset($_GET['id_formation'])) { ?>
          <h2 class="section-heading text-uppercase">Ajouter une éxperience</h2><br>
          <?php }else{ ?>
          <h2 class="section-heading text-uppercase">Modifier une éxperience</h2><br>
          <?php } ?>
        </div>
      <form action="" method="post">

        <div class="form-group">
                <input class="form-control"  type="text" name="periode" value="<?= $periode_m; ?>" placeholder="Période de l'éxperience *" required="required" data-validation-required-message="Veuillez saisir la période de la formation." />
                    <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="libelle" value="<?= $designation_m; ?>" placeholder="Votre rôle dans l'experience *" required="required" data-validation-required-message="Veuillez saisir votre rôle." />
                    <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="description" value="<?= $description_m; ?>" placeholder="Description de la formation *" required="required" data-validation-required-message="Veuillez saisir la description de l'experience." />
                    <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="entreprise" value="<?= $entreprise_m; ?>" placeholder="Entreprise d'accueil *" required="required" data-validation-required-message="Veuillez saisir l'entreprise d'accueil." />
                    <p class="help-block text-danger"></p>
            </div>

            <input type="hidden" name="flag" value="<?= $flag_m;?>">
            <input type="hidden" name="idam" value="<?= $id_experience;?>">

            <div class="text-center">
              <div id="success"></div>
                <br><button class="btn btn-xl btn-primary" id="sendMessageButton" type="submit" name="sub">Confirmer
                </button>
                <a href="moncv.php" class="btn btn-xl btn-danger">Annuler</a>
            </div>
      </form>   

    </div>
  </header>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/stylish-portfolio.min.js"></script>
</body>
</html>