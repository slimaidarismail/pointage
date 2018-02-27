<?php
// Declaration des variables
	$id_user = $mail_user = $mdp_user = $nom_user  = $prenom_user  = null;

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$utilisateur = recuperer_utilisateurs($id)->fetch();
	
	$id_user		= $utilisateur["id_user"];
	$mail_user		= $utilisateur["mail_user"];
	$mdp_user 		= $utilisateur["mdp_user"];
	$nom_user 		= $utilisateur["nom_user"];
	$prenom_user	= $utilisateur["prenom_user"];
}
