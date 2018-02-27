<?php include("../includes/header.php"); ?>
<?php
	$crit =null;
	if(isset($_GET['s']))
	{
		if($_GET['s'] == "enseignants") $crit =  " AND  nom_groupe_salarie='Enseignants - primaire'";
		elseif($_GET['s'] == "femmes-de-menage") $crit = " AND  nom_groupe_salarie='Femmes de menage'";
		elseif($_GET['s'] == "professeurs") $crit = " AND  nom_groupe_salarie='Professeurs'";
		elseif($_GET['s'] =="administartion") $crit = " AND  nom_groupe_salarie='Administration'";
		elseif($_GET['s'] =="it-informatique") $crit = " AND  nom_groupe_salarie='IT Informatique'";
		
	}
?>


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Salariés
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box ">
        <div class="box-body">
            <div class="table-responsive">
        	<table class="table table-bordered table-hover dataTable" id="dataTable">
            	<thead>
                	<tr>
                    	<th>Nom</th>
                    	<th>Prénom</th>
                    	<th>Groupe</th>
                    	<th>Profession</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach (recuperer_salarie('', $crit) as $salarie)
					{
						?>
                        <tr>
                        	<td><?php echo $salarie['nom_salarie'] ?></td>
                        	<td><?php echo $salarie['prenom_salarie'] ?></td>
                        	<td><?php echo $salarie['nom_groupe_salarie'] ?></td>
                        	<td><?php echo $salarie['profession_salarie'] ?></td>
                        </tr>
                        <?php 
					}
					?>
                   </tbody>
            </table>
            </div>
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

