<?php	
	session_start();
	unset($_SESSION['login']);
	unset($_SESSION['nom']);
	unset($_SESSION['prenom']);
	unset($_SESSION['passe']);
	unset($_SESSION['id_user']);
	unset($_SESSION['photo']);
	unset($_SESSION['post']);
	unset($_SESSION['email']);

	
	header("Location: index.php");
	
?>