<?php
	include("../../includes/config.php");
	include("../../includes/functions.php");

	$dbh=connexion() ;
	if (!empty ($_FILES['userfile']))
	{
		$files = save_file($_FILES['userfile'], "../../salaries/xlsx/");
		require('../../includes/classes/XLSXReader.php');
		$xlsx = new XLSXReader($files);
		$sheetNames = $xlsx->getSheetNames();
		$first = false;

		foreach($sheetNames as $sheetName) {
			$sheet = $xlsx->getSheet($sheetName);
			$rows = $sheet->getData();
			if( $sheetName == "Salaries" ){
			foreach($rows as $row) {
				$id_salarie_pointeuse = $id_groupe_salarie = $nom_salarie = $prenom_salarie = $profession_salarie = null;
				
				if($first)
				{
				
					$nom_salarie 			= isset($row[0])?$row[0] : "";
					$prenom_salarie 		= isset($row[1])?$row[1] : "";
					$id_groupe_salarie		= isset($row[2])?$row[2] : "Administration";
					$profession_salarie 	= isset($row[3])?$row[3] : "";
					$id_salarie_pointeuse	= isset($row[4])?$row[4] : "";
					
					if($id_groupe_salarie=="Administration") $id_groupe_salarie = 1;
					if($id_groupe_salarie=="Enseignants - primaire") $id_groupe_salarie = 2;
					if($id_groupe_salarie=="Professeurs") $id_groupe_salarie = 3;
					if($id_groupe_salarie=="Femmes de menage") $id_groupe_salarie = 4;
					
					$stmt = $dbh->prepare("INSERT INTO salaries (id_salarie_pointeuse, id_groupe_salarie, nom_salarie, prenom_salarie, profession_salarie) 												VALUES (:id_salarie_pointeuse, :id_groupe_salarie, :nom_salarie, :prenom_salarie, :profession_salarie)");
					$stmt->bindParam(':id_salarie_pointeuse', $id_salarie_pointeuse);
					$stmt->bindParam(':id_groupe_salarie', $id_groupe_salarie);
					$stmt->bindParam(':nom_salarie', $nom_salarie);
					$stmt->bindParam(':prenom_salarie', $prenom_salarie);
					$stmt->bindParam(':profession_salarie', $profession_salarie);
			$stmt->execute();
				}
				$first =true;
			}
	
	echo '<script>document.location.href="'.root.'salaries/?alert=1" </script>';		}
		}
	}
