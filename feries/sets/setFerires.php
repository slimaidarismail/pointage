<?php
	include("../../includes/config.php");
	include("../../includes/functions.php");
	
	$dbh=connexion() ;
	
	if(empty($_POST['id_jour_ferie']))
		{$stmt = $dbh->prepare("INSERT INTO jours_feries (nom_jour_ferie, du_au) 
													VALUES (:nom_jour_ferie, :du_au)");}
	else 
		{$stmt = $dbh->prepare("UPDATE jours_feries SET 
												nom_jour_ferie = :nom_jour_ferie,
												du_au = :du_au
												WHERE id_jour_ferie=".$_POST['id_jour_ferie']);}
		
		
													
		$stmt->bindParam(':nom_jour_ferie', $_POST['nom_jour_ferie']);
		$stmt->bindParam(':du_au', $_POST['du_au']);
		$stmt->execute();


	if(!empty($_POST['id_jour_ferie'])){ $lastId=$_POST['id_jour_ferie'];}
	else  $lastId = $dbh->lastInsertId();

	echo '<script>document.location.href="'.root.'feries/single.php?id='.$lastId.'&alert=1" </script>';