<?php
include("connexion.php");
session_start();

if(isset($_POST['sub'])){

	// ------------------ RECUPERESTION DES DONNES DU FORMULAIRE 
	//						& FORMATAGE(uppercase et capitalize) ------------------

	$nom=strtoupper($_POST['nom']);
	$prenom=ucfirst(strtolower($_POST['prenom']));
	$login=$_POST['login'];
	$passe=$_POST['passe'];
	$passe=md5($passe); //CRYPTAGE DU MOT DE PASSE AVEC MD5
	$date=$_POST['date'];
	$ville=$_POST['ville'];
	$post=ucfirst(strtolower($_POST['post']));;
	$email=$_POST['email'];
    
	if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0){
		$dossier= 'photo/';
		$temp_name=$_FILES['fichier']['tmp_name'];
		if(!is_uploaded_file($temp_name)){
		exit("le fichier est untrouvable");
		}
		$infosfichier = pathinfo($_FILES['fichier']['name']);
		$extension_upload = $infosfichier['extension'];
		if ($_FILES['fichier']['size'] >= 1000000){
			exit("Erreur, le fichier est volumineux");
		}
		$extension_upload = strtolower($extension_upload);
		$extensions_autorisees = array('png','jpeg','jpg');
		if (!in_array($extension_upload, $extensions_autorisees))
		{
		exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
		}
		$nom_photo=$login.".".$extension_upload;
		if(!move_uploaded_file($temp_name,$dossier.$nom_photo)){
		exit("Problem dans le telechargement de l'image, Ressayez");
		}
		$ph_name=$nom_photo;
	}
	else{
		$ph_name="SANS_IMAGE.png";
	}

	$request = $PDO->prepare("INSERT INTO user (login,passe,nom,prenom,date_naissance,id_ville,photo,post,email) VALUES(:login,:passe,:nom,:prenom,:date,:ville,:ph_name,:post,:email)");
	$request->bindValue(":login",$login);
	$request->bindValue(":passe",$passe);
	$request->bindValue(":nom",$nom);
	$request->bindValue(":prenom",$prenom);
	$request->bindValue(":date",$date);
	$request->bindValue(":ville",$ville);
	$request->bindValue(":ph_name",$ph_name);
	$request->bindValue(":post",$post);
	$request->bindValue(":email",$email);
	$request->execute();
	
	header('location: login.php');
}
?>