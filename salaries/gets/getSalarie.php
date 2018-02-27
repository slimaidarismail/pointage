<?php
// Declaration des variables
	$id_salarie = $id_salarie_pointeuse = $id_groupe_salarie = $nom_salarie = $prenom_salarie = $profession_salarie = null;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$salaries = recuperer_salarie($id);
	$salarie = $salaries->fetch();
	
	$id_salarie				=  $salarie["id_salarie"];
	$id_salarie_pointeuse	=  $salarie["id_salarie_pointeuse"];
	$id_groupe_salarie		=  $salarie["id_groupe_salarie"];
	$nom_salarie			=  $salarie["nom_salarie"];
	$prenom_salarie			=  $salarie["prenom_salarie"];
	$profession_salarie		=  $salarie["profession_salarie"];
}
