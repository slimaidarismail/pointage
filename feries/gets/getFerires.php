<?php
// Declaration des variables
	$id_jour_ferie = $date_jour_ferie = $nom_jour_ferie = $du_au  = null;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$jrFeriers = recuperer_jourFeriers($id)->fetch();
	
	$id_jour_ferie		=  $jrFeriers["id_jour_ferie"];
	$nom_jour_ferie		=  $jrFeriers["nom_jour_ferie"];
	$du_au				=  $jrFeriers["du_au"];
}
