<?php include("../includes/header.php"); ?>

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
          <h3 class="box-title"><i class="glyphicon glyphicon-user"></i> Salariés</h3>
          <div class="box-tools pull-right">
             <a class="btn-xs text-orange" href="single.php" ><i class="fa fa-plus"></i> Nouveau</a>
             <a class="btn-xs text-green export" id="listDownload"><i class="fa fa-file-excel-o"></i> Excel</a>
             <a class="btn-xs text-black" href="javascript:window.print()"><i class="fa fa-print"></i> Imprimer</a>
          </div>
        </div>
        <div class="box-body">
        	<table class="table table-bordered table-hover dataTable" id="dataTable">
            	<thead>
                	<tr>
                    	<th>ID</th>
                    	<th>Nom</th>
                    	<th>Du - Au</th>
                    	<th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (recuperer_jourFeriers() as $jrFeries)
					{
						?>
                        <tr>
                        	<td><?php echo $jrFeries['id_jour_ferie'] ?></td>
                        	<td><?php echo $jrFeries['nom_jour_ferie'] ?></td>
                        	<td><?php echo $jrFeries['du_au'] ?></td>
                        	<th>
                                <a class="btn btn-success btn-xs" href="single.php?id=<?php echo $jrFeries['id_jour_ferie'] ?>"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="<?php echo root?>includes/delete.php?table=jours_feries&column=id_jour_ferie&value=<?php echo $jrFeries['id_jour_ferie'] ?>&link=feries"><i class="fa fa-trash-o"></i></a>
                            </th>
                        </tr>
                        <?php 
					}
					?>
                   </tbody>
            </table>
            <?php //var_dump(connexionSQLserver()); ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<!-- Main content -->

<div class="modal fade" id="uploadXcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Envoyer un fichier</h4>
      </div>
      <div class="modal-body">
		<form action="sets/setFiles.php" method="post" enctype="multipart/form-data">
			<div class="input-group">
				<input type="file" class="form-control" id="userfile" name="userfile">
				<span class="input-group-btn">
					<input type="submit" value="Envoyer" class="btn btn btn-info" name="submit">
				</span>
			</div>
		</form>
      </div>
    </div>
  </div>
</div>
<?php include("../includes/footer.php"); ?>
<script type="text/javascript">
   $(document).ajaxStart(function() { Pace.restart(); });
</script>
<script>
	$( document ).ready(function() {
		$(".export").on('click', function (event) {
			exportTableToCSV.call(this, $('table'), 'Salaries.csv');
		});
		$("#dataTable").DataTable();
   });
</script>

