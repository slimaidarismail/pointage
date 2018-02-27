<?php include("../includes/header.php"); ?>
<?php include("gets/getFerires.php"); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Gestion des jours fériés
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo root; ?>"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="#">Liste</a></li>
        <li class="active">Gestion des jours fériérs</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-star-o"></i> Jours Fériés</h3>

          <div class="box-tools pull-right">
          	<a href="single.php" class="btn btn-twitter btn-xs"><i class="fa fa-plus"></i> Nouveau</a>
          </div>
        </div>
        <div class="box-body">
            <form action="sets/setFerires.php" method="post">
                <div class="row margin-bottom">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon "><i class="fa fa-font"></i></span>
                            <input type="text" class="form-control " placeholder="Nom" name="nom_jour_ferie" value="<?php echo $nom_jour_ferie;  ?>">
                        </div>     
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="du_au" name="du_au" value="<?php echo $du_au ?>">
                            </div>
                        </div>    
                    </div>
				</div>
                <div class="row margin-bottom">
                	<div class="col-md-6">
                		<button class="btn btn-flat btn-success"><i class="fa fa-floppy-o"></i> Enregistrer</button>
                    </div>
                    <div class="col-md-6">
                    	<input type="hidden" name="date_jour_ferie" id="date_jour_ferie" value="<?php echo $date_jour_ferie;?>">
                    	<input type="hidden" name="id_jour_ferie" id="id_jour_ferie" value="<?php echo $id_jour_ferie;?>">
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

<script>
	$( document ).ready(function() {
		
		$('#du_au').daterangepicker({
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
   });
   
</script>