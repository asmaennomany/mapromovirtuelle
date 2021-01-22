<?php
session_start();

// ---------------- SECURISATION ----------------

if (!isset($_SESSION['login'])) {
    header('location: index.php');
  }

// ---------------- RECUPERATION USER ----------------

include("connexion.php");
$id_user=$_SESSION['id_user'];


// ---------------- SUPPRESSION D'UNE LANGUE ----------------

if (isset($_GET['id_a_supprime'])) {
  $id_langue=$_GET['id_a_supprime'];

  $request = $PDO->prepare("DELETE FROM user_langue WHERE id_langue= :id_langue AND id_user= :id_user");
  $request->bindValue(":id_langue",$id_langue);
  $request->bindValue(":id_user",$id_user);
  $request->execute();

  header('location: moncv.php');
}


// ---------------- AJOUT DES DONNEES ----------------

if(isset($_POST['sub']) && $_POST['flag']==""){
  $langue=$_POST['langue'];
  $niveau=$_POST['niveau'];

  $request = $PDO->prepare("INSERT INTO user_langue VALUES(:langue,:id_user,:niveau)");
  $request->bindValue(":langue",$langue);
  $request->bindValue(":id_user",$id_user);
  $request->bindValue(":niveau",$niveau);
  $request->execute();

  header('location: moncv.php');
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
          <h2 class="section-heading text-uppercase">Ajouter une langue</h2><br>
        </div>

      <form action="" method="post">
        <div class="form-group">
          <h3>Langue :</h3>
          <select name="langue" required="required" class="form-control">
                <?php
                $request = $PDO->prepare("SELECT * FROM langue");
                $request->execute(); 
                while ($list = $request->fetch(PDO::FETCH_ASSOC)) {
                  echo '<option value='.$list['id_langue'].'>';
                  echo $list['libelle_langue'];
                  echo '</option>';
                }
              ?>
            </select>
        </div>
        <div class="form-group">
          <h3>Niveau :</h3>
          <select name="niveau" required="required" class="form-control">
            <option value="C2" selected>C2</option>
            <option value="C1">C1</option>
            <option value="B2">B2</option>
            <option value="B1">B1</option>
            <option value="A2">A2</option>
            <option value="A1">A1</option>
          </select>
        </div>
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