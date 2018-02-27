<?php include("../includes/header.php"); ?>
<?php include("gets/getUtilisateur.php"); ?>

<?php // if ($_SESSION['7_permission']==0) echo '<script>document.location.href="permission.php"</script>';?>
<?php 
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
	 	$existe=0;
		$db=connexion() ;
		 foreach($db->query('SELECT * FROM utilisateurs WHERE corbeille_user=1 AND id_user='.$id) as $row){$existe+=1;};
		if($existe==0) {echo '<script>document.location.href="/"</script>';	}
	}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header ">
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
      <div class="row">
       <div id="new_menu" style="display:none"">
        	<a class="btn btn-app"style="float:right" href="vp-includes/vp-corbeille.php?code=utilisateurs-<?php echo $_GET['utilisateur'] ?>">
            	<i class="fa fa-trash-o"></i> Corbeille
             </a>
          	<a class="btn btn-app"style="float:right" href="single.php">
            	<i class="fa fa-plus-circle"></i> Creation
             </a>
          </div>
          </div>
      <div class="box">
      
      <form role="form" action="sets/setUtilisateur.php" method="post"  enctype="multipart/form-data">
            
         <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i> &nbsp;Informations</h3>
         </div>
         <div class="box-body">
               <!-- text input -->
               <div class="row">
               		<div class="col-md-6">
                       <div class="form-group">
                          <label>Nom </label>
                          <input type="text" required name="nom_user" id="nom_user" value="<?php echo $nom_user ?>" class="form-control" placeholder="Entrez le nom ici"/>
                       </div>
                   </div>
               		<div class="col-md-6">
                       <div class="form-group">
                          <label>Prénom </label>
                          <input type="text" required name="prenom_user" id="prenom_user" value="<?php echo $prenom_user ?>"  class="form-control" placeholder="Entrez le prénom ici"/>
                       </div>
               		</div>
               </div>
               <div class="row">
               		<div class="col-md-6">
                       <div class="form-group">
                          <label>E-mail </label>
                          <input type="text" required name="mail_user" id="mail_user" value="<?php echo $mail_user ?>" class="form-control" placeholder="Entrez votre mail ici"/>
                       </div>
                   </div>
               		<div class="col-md-6">
                       <div class="form-group">
                          <label>Mot de passe</label>
                          <input type="password"  name="mdp_user" id="mdp_user" class="form-control" placeholder="*****"/>
                       </div>
               		</div>
               </div>
               <input type="hidden" id="id_user" name="id_user" value="<?php echo $id_user; ?>">
               <input type="hidden" id="mdp_user_hidden" name="mdp_user_hidden" value="<?php echo $mdp_user; ?>">
         </div>
         <!-- /.box-body -->
         <div class="box-footer">
         	<button type="submit" id="Enregister" name="Enregister" class="btn btn-success btn-flat"><i class="fa fa-floppy-o"></i> Enregister</button>
         </div>
         <!-- /.box-footer-->
      </form>
      </div>
      <!-- /.box -->
      
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../includes/footer.php') ?>