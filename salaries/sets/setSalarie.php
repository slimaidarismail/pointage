<?php
	include("../../includes/config.php");
	include("../../includes/functions.php");
	
	$dbh=connexion() ;
	
	if(empty($_POST['id_salarie']))
		{$stmt = $dbh->prepare("INSERT INTO salaries (id_salarie_pointeuse, id_groupe_salarie, nom_salarie, prenom_salarie, profession_salarie) 
												VALUES (:id_salarie_pointeuse, :id_groupe_salarie, :nom_salarie, :prenom_salarie, :profession_salarie)");}
	else 
		{$stmt = $dbh->prepare("UPDATE salaries SET 
												id_salarie_pointeuse = :id_salarie_pointeuse,
												id_groupe_salarie = :id_groupe_salarie,
												nom_salarie = :nom_salarie,
												prenom_salarie =:prenom_salarie,
												profession_salarie =:profession_salarie
												WHERE id_salarie=".$_POST['id_salarie']);}
														
			$stmt->bindParam(':id_salarie_pointeuse', $_POST['id_salarie_pointeuse']);
			$stmt->bindParam(':id_groupe_salarie', $_POST['id_groupe_salarie']);
			$stmt->bindParam(':nom_salarie', $_POST['nom_salarie']);
			$stmt->bindParam(':prenom_salarie', $_POST['prenom_salarie']);
			$stmt->bindParam(':profession_salarie', $_POST['profession_salarie']);
			$stmt->execute();

			if(!empty($_POST['id_salarie'])){ $lastId=$_POST['id_salarie'];}
			else  $lastId = $dbh->lastInsertId();

			echo '<script>document.location.href="'.root.'salaries/single.php?id='.$lastId.'&alert=1" </script>';