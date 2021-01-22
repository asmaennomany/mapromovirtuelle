<?php

session_start();

// ---------------- SECURISATION ----------------
if (!isset($_SESSION['login'])) {
    header('location: index.php');
  }

// ---------------- RECUPERATION USER ----------------

include("connexion.php");
$id_user=$_SESSION['id_user'];


// ---------------- SUPPRESSION D'UNE FORMATION ----------------

if (isset($_GET['id_a_supprimer'])) {
  $id_formation=$_GET['id_a_supprimer'];

  $request = $PDO->prepare("DELETE FROM formation WHERE id_formation= :id_formation");
  $request->bindValue(":id_formation",$id_formation);
  $request->execute();

  header('location: moncv.php');
}



// ---------------- AJOUT DES DONNEES ----------------

if(isset($_POST['sub']) && $_POST['flag']==""){
  $periode=$_POST['periode'];
  $libelle=$_POST['libelle'];
  $description=$_POST['description'];

  $request = $PDO->prepare("INSERT INTO formation VALUES(NULL,:id_user,:periode,:libelle,:description)");
  $request->bindValue(":id_user",$id_user);
  $request->bindValue(":periode",$periode);
  $request->bindValue(":libelle",$libelle);
  $request->bindValue(":description",$description);
  $request->execute();

  header('location: moncv.php');
}


// ---------------- MODIFICATION DES DONNEES ----------------

if (isset($_POST['flag']) && $_POST['flag']!="") {

  $_POST['flag']="";
  
  $periode=$_POST['periode'];
  $libelle=$_POST['libelle'];
  $description=$_POST['description'];
  $id_formation=$_POST['idm'];

  $request = $PDO->prepare("UPDATE formation SET periode_formation=:periode, libelle_formation=:libelle, description_formation=:description WHERE id_formation=:id_formation");
  
  $request->bindValue(":periode",$periode);
  $request->bindValue(":libelle",$libelle);
  $request->bindValue(":description",$description);
  $request->bindValue(":id_formation",$id_formation);

  $request->execute();

  header('location: moncv.php');
}


// ---------------- RECUPERATION DES INFOS | CAS DE MODIFICATION----------------

//par defaut
$periode_m=$designation_m=$description_m=$flag_m="";

//DB
if (isset($_GET['id_formation'])) {

  $id_formation=$_GET['id_formation'];
  $flag_m="vrai";

  $request = $PDO->prepare("SELECT * FROM formation WHERE id_formation= :id_formation");
  
  $request->bindValue(":id_formation",$id_formation);
  
  $request->execute();

  $data = $request->fetch(PDO::FETCH_ASSOC);

  //Valeur à afficher dans le formulaire de modification
  $periode_m=$data['periode_formation'];
  $designation_m=$data['libelle_formation'];
  $description_m=$data['description_formation'];



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
            <h2 class="section-heading text-uppercase">Modifier une formation</h2><br>
         <?php }else{ ?>
          <h2 class="section-heading text-uppercase">Ajouter une formation</h2><br>
          <?php } ?>

        </div>
      <form action="" method="post">

        <div class="form-group">
                <input class="form-control"  type="text" name="periode" placeholder="Période de la formation *" value="<?= $periode_m; ?>" required="required" data-validation-required-message="Veuillez saisir la période de la formation."  />
                    <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="libelle" placeholder="Nom de la formation *" required="required" value="<?= $designation_m; ?>" data-validation-required-message="Veuillez saisir le nom de la formation." />
                    <p class="help-block text-danger"></p>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="description" placeholder="Description de la formation *" value="<?= $description_m; ?>" required="required" data-validation-required-message="Veuillez saisir la description de la formation."><?php if($description_m!="") echo $description_m ?></textarea>
                    <p class="help-block text-danger"></p>
            </div>
            <input type="hidden" name="flag" value="<?= $flag_m;?>">
            <input type="hidden" name="idm" value="<?= $id_formation;?>">

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

