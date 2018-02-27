<?php
	include("../../../includes/config.php");
	include("../../../includes/functions.php");

	$dbh=connexion() ;
	if (!empty ($_FILES['userfile']))
	{
		$files = save_file($_FILES['userfile'], "../../../administrateur/eleves/xlsx/");
		require('../../../classes/XLSXReader.php');
		$xlsx = new XLSXReader($files);
		$sheetNames = $xlsx->getSheetNames();
		$first = false;

		foreach($sheetNames as $sheetName) {
			$sheet = $xlsx->getSheet($sheetName);
			$rows = $sheet->getData();
			foreach($rows as $row) {
				$nom_eleve = $prenom_eleve = $date_naissance_eleve = $cne_eleve = "";
				if($first)
				{
					$nom_eleve 		= $row[0];
					$prenom_eleve 	= $row[1];
					$cne_eleve		= $row[2];
					$date_naissance_eleve = $row[3];
					
					$stmt = $dbh->prepare("INSERT INTO eleves (nom_eleve, prenom_eleve, date_naissance_eleve, cne_eleve) 
													VALUES (:nom_eleve, :prenom_eleve, :date_naissance_eleve, :cne_eleve)");
					$stmt->bindParam(':nom_eleve', $nom_eleve);
					$stmt->bindParam(':prenom_eleve', $prenom_eleve);
					$stmt->bindParam(':date_naissance_eleve', $date_naissance_eleve);
					$stmt->bindParam(':cne_eleve', $cne_eleve);
					$stmt->execute();
					
				}
				$first =true;
			}
		}
	}
	echo '<script>document.location.href="http://localhost/i-exsam/administrateur/eleves/?alert=1" </script>';