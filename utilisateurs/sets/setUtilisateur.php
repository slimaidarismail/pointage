<?php
	include("../../includes/config.php");
	include("../../includes/functions.php");
	
	$dbh=connexion() ;
	
	$id_user = $mail_user = $mdp_user = $nom_user  = $prenom_user  = null;
	
	if(empty($_POST['id_user']))
		{$stmt = $dbh->prepare("INSERT INTO utilisateurs (mail_user, mdp_user, nom_user, prenom_user) 
													VALUES (:mail_user, :mdp_user, :nom_user, :prenom_user)");}
	else 
		{$stmt = $dbh->prepare("UPDATE utilisateurs SET 
												mail_user = :mail_user,
												mdp_user = :mdp_user,
												nom_user = :nom_user,
												prenom_user = :prenom_user
												WHERE id_user=".$_POST['id_user']);}
												
		$mdp_user = empty($_POST['mdp_user'])? $_POST['mdp_user_hidden'] : md5($_POST['mdp_user']) ;
		$stmt->bindParam(':mail_user', $_POST['mail_user']);
		$stmt->bindParam(':mdp_user', $mdp_user);
		$stmt->bindParam(':nom_user', $_POST['nom_user']);
		$stmt->bindParam(':prenom_user', $_POST['prenom_user']);
		$stmt->execute();


	if(!empty($_POST['id_user'])){ $lastId=$_POST['id_user'];}
	else  $lastId = $dbh->lastInsertId();

	echo '<script>document.location.href="'.root.'utilisateurs/single.php?id='.$lastId.'&alert=1" </script>';