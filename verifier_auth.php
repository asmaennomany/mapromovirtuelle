<?php

session_start();
include("connexion.php");


		$login=(isset($_GET['login']))? $_GET['login'] : "";
		$passe=(isset($_GET['passe']))? md5($_GET['passe']) : "";
		if (empty($login) or empty($passe)) {
			print "Saisissez votre login et votre password !!"."<br>";
			print"<a href='javascript: history.go(-1)'>Retour</a>";
		}
		else
		{	
			$request = $PDO->prepare("SELECT * FROM user WHERE login= :login AND passe= :passe");
			$request->bindValue(":login",$login);
			$request->bindValue(":passe",$passe);
			$request->execute();
			$row = $request->fetch(PDO::FETCH_ASSOC);

			
			if ($row!=False) {
			
				$_SESSION['login']=$row['login'];
				$_SESSION['passe']=$row['passe'];
				$_SESSION['nom']=$row['nom'];
				$_SESSION['prenom']=$row['prenom'];
				$_SESSION['id_user']=$row['id_user'];
				$_SESSION['photo']=$row['photo'];
				$_SESSION['post']=$row['post'];
				$_SESSION['email']=$row['email'];

				
				
				 
				
				header("Location: moncv.php");
			}
			else{
				?>
				<div class="alert alert-warning">
  					<h3>ERREUR!</h3>
  					<p>Mot de passe ou login incorrect.</p><br>
				</div>
				<?php
				print"<a href='javascript: history.go(-1)'>Retour</a>";
			}
		}
?>
