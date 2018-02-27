<?php 
// Connexion à la base de données
function connexion() 
{
	try {
	return new PDO('mysql:host='.db_host.';dbname='. db_dbname, db_user, db_pass);
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
}

function connexionSQLserver() 
{
	$serverName = db_host_sqlserver; //serverName\instanceName
		
	$connectionInfo = array( 'CharacterSet' => 'UTF-8',"Database"=>db_dbname_sqlserver);
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
	
	if( $conn ) {
		return $conn;
	}else{
		echo "Connection could not be established.<br />";
		die( print_r( sqlsrv_errors(), true));
	}
}			   
			   
function recupererDebutTexte ($origine, $taille)
{
	$longueurAGarder= $taille;
	if (strlen ($origine) <= $longueurAGarder)
	return $origine;
	$debut = substr ($origine, 0, $longueurAGarder);
	$debut = substr ($debut, 0, strrpos ($debut, ' ')) . '...';
	return strip_tags($debut);
}
function array2csv(array &$array)
{
	if (count($array) == 0) { return null; }
	ob_start();
	$df = fopen("php://output", 'w');
	fputcsv($df, array_keys(reset($array)));
	foreach ($array as $row) {
		fputcsv($df, $row);
	}
	fclose($df);
	return ob_get_clean();
}
function array2Table($data) {
	echo '<table>';
	foreach($data as $row) {
		echo "<tr>";
			foreach($row as $cell) {
				  echo " <td>" . escape($cell) . "</td>";
				  }
		echo "</tr> ";
	}
	echo '</table>';
}
function debug($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}
function escape($string) {
	return htmlspecialchars($string, ENT_QUOTES);
}
function save_file($userfile, $path){
	$target_file = $path . basename($userfile["name"]);
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$newName="";
	if($FileType != "xlsx" ) {
		echo "Désolé, Seulement les csv.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {echo "Désolé, echec.";} 
	else {
	$newName = $path.'/fileXlsx-'.time().'.csv';
	if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $newName)) { return $newName;} 
	else {echo '
		<div class="alert alert-danger" role="alert">Désolé, erreur d\upload.</div>
	';}
	}
	return "";
}
function get_mois($RecDateM = null)
{
	$date = "";
	
	$date .= '<div class="form-group">';
		$date .= '<select class="form-control" name="RecDateM" id="RecDateM">';
			$date .= '<option value="1">Janvier</option>';
			$date .= '<option value="2">Février</option>';
			$date .= '<option value="3">Mars</option>';
			$date .= '<option value="4">Avril</option>';
			$date .= '<option value="5">Mai</option>';
			$date .= '<option value="6">Juin</option>';
			$date .= '<option value="7">Juillet</option>';
			$date .= '<option value="8">Août</option>';
			$date .= '<option value="9">Septembre</option>';
			$date .= '<option value="10">Otobre</option>';
			$date .= '<option value="11">Novembre</option>';
			$date .= '<option value="12">Décembre</option>';
		$date .= '</select>';
	$date .= '</div>';
	return  $date ;
}
function get_annes($RecDateY = null)
{
	$date = "";
	$date .= '<div class="form-group">';
		$date .= '<select class="form-control" name="RecDateY" id="RecDateY">';
		for($i=2016; $i<2027 ;$i++ ){
			$S ="";
			if($RecDateY == $i) $S = "Selected";
			$date .= '<option value="'.$i.'"'.$S.'>'.$i.'</option>';
		}
		$date .= '</select>';
	$date .= '</div>';
	return  $date ;
}
function get_count($table, $critere = null){
	$dbh=connexion() ;		
	foreach($dbh->query('SELECT COUNT(*) FROM '. $table. ' ' . $critere) as $row) {}
	$dbh = null;
	return $row[0];
}
function get_atdRecord(){
	$dbh=connexion() ;		
	foreach($dbh->query('SELECT MAX(SerialId) AS last FROM atdrecord') as $row) {}
	$dbh = null;
	$last = ($row[0]==null)? 0 :$row[0];
	return $last;
}
function synchonisation(){
	$conn	=	connexionSQLserver();
	$dbh	=	connexion() ;

	$sql	=	"SELECT * FROM AtdRecord WHERE SerialId >= ". get_atdRecord();
	$stmt	= 	sqlsrv_query( $conn, $sql );
	if($stmt === false){
		die(print_r(sqlsrv_errors(),true));
	}
	else
	if(sqlsrv_fetch($stmt) ===false){
			echo "fetch error";
			die(print_r(sqlsrv_errors(),true));
	}else
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			$SerialId 	= $row["SerialId"];
			$CardNo		= $row["CardNo"];
			$RecDate	= explode(' ',$row["dateb"])[0];
			$RecTime	= $row["RecTime"];
			$dateb	= $row["dateb"];
						
			$stmtMySQl = $dbh->prepare("INSERT INTO atdrecord (SerialId, CardNo, RecDate, RecTime, dateb) 
									VALUES (:SerialId, :CardNo, :RecDate, :RecTime, :dateb)");
			$stmtMySQl->bindParam(':SerialId', $SerialId);
			$stmtMySQl->bindParam(':CardNo', $CardNo);
			$stmtMySQl->bindParam(':RecDate', $RecDate);
			$stmtMySQl->bindParam(':RecTime', $RecTime);
			$stmtMySQl->bindParam(':dateb', $dateb);
			$stmtMySQl->execute();
						
		}	

	sqlsrv_free_stmt( $stmt);	
	$dbh	=	connexion() ;
}

function tableToOptionSelect($table, $value, $select, $critere =null, $ValueSelected =null){
	$dbh=connexion() ;
	$selected = "selected";
	foreach($dbh->query('SELECT * FROM '.$table.' '.$critere) as $row) {
		($ValueSelected ==$row[$value]) ? $selected = "selected" : $selected = "";
		$options.= '<option value="'.$row[$value].'" '.$selected. ' > '.$row[$select].'</option> ';
	}
	$dbh = null;
	return $options;
}
function deleteColumn($table, $column, $value, $link=null)
{
	$dbh=connexion() ;
	var_dump($dbh->query('DELETE FROM '.$table.' WHERE '.$column.'='.$value));
	$dbh = null;

	echo '<script>document.location.href="'.root.$link.'" </script>';
}
function recuperer_salarie($id = null, $crit=null)
{
	$dbh=connexion() ;	
	if (!empty($id))$id = ' AND id_salarie = ' . $id;
	$resulat =$dbh->query('SELECT * FROM salaries S, groupes_salaries GS WHERE GS.id_groupe_salarie = S.id_groupe_salarie ' . $id . $crit);
	$dbh = null;
	return $resulat;
}
function recuperer_jourFeriers($id = null, $crit=null)
{
	$dbh=connexion() ;	
	if (!empty($id))$id = ' WHERE id_jour_ferie = ' . $id;
	$resulat =$dbh->query('SELECT * FROM jours_feries ' . $id . $crit);
	$dbh = null;
	return $resulat;
}

function recuperer_utilisateurs($id = null, $crit=null)
{
	$dbh=connexion() ;	
	if (!empty($id))$id = ' WHERE id_user = ' . $id;
	$resulat =$dbh->query('SELECT * FROM utilisateurs ' . $id . $crit);
	$dbh = null;
	return $resulat;
}


function recuperer_pointage($crit=null)
{
	$dbh=connexion() ;	
	$resulat =$dbh->query('SELECT * FROM salaries S LEFT JOin groupes_salaries GS ON GS.id_groupe_salarie = S.id_groupe_salarie
						LEFT JOIN atdrecord A On S.id_salarie_pointeuse = CAST(A.CardNo AS UNSIGNED) '.$crit);
	$dbh = null;
	return $resulat;        

}