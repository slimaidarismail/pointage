<?php include("../includes/header.php"); ?>
<?php include("gets/getSalarie.php"); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestion des Salariés
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo root; ?>"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="salaries">Salariés</a></li>
        <li class="active">Gestion des salaries</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Salarié</h3>

          <div class="box-tools pull-right">
          	<a href="single.php" class="btn btn-twitter btn-xs"><i class="fa fa-plus"></i> Nouveau</a>
          </div>
        </div>
        <div class="box-body">
            <form action="sets/setSalarie.php" method="post">
                <div class="row margin-bottom">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon "><i class="fa fa-font"></i></span>
                            <input type="text" class="form-control " placeholder="Nom" name="nom_salarie" value="<?php echo $nom_salarie;  ?>">
                        </div>     
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                            <input type="text" class="form-control" placeholder="Prénom" name="prenom_salarie" value="<?php echo $prenom_salarie;  ?>">
                        </div>     
                    </div>
				</div>
                <div class="row margin-bottom">
                    <div class="col-md-4">
                        <div class="input-group">
							<span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
							<div class="form-group">
								<select class="form-control" name="id_groupe_salarie" id="id_groupe_salarie">
									<?php echo(tableToOptionSelect("groupes_salaries","id_groupe_salarie","nom_groupe_salarie","", $id_groupe_salarie));  ?>
								</select>
							</div>
                        </div>     
                    </div>
                    
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cog"></i></span>
                            <input type="text" class="form-control" placeholder="Profession" name="profession_salarie" value="<?php echo $profession_salarie;  ?>">
                        </div>     
                    </div>
                    
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-hand-up"></i></span>
                            <input type="text" class="form-control" placeholder="ID Pointeuse" name="id_salarie_pointeuse" value="<?php echo $id_salarie_pointeuse;  ?>">
                        </div>     
                    </div>
                    
                </div>
                <div class="row margin-bottom">
                	<div class="col-md-6">
                		<button class="btn btn-flat btn-success"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                    </div>
                    <div class="col-md-6">
                    	<input type="hidden" name="id_salarie" id="id_salarie" value="<?php echo $id_salarie;?>">
                    </div>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("../includes/footer.php"); ?>