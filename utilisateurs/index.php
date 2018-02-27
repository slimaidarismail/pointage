<?php include("../includes/header.php"); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header ">
      <h1>
         Liste des utilisateurs
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Default box -->
	<div class="box">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Pseudo</th>
                        <th>Nom et Prénom</th>
                        <th>Mail</th>
                        <th>Date d'inscription</th>
                        <th>Groupe</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  	$dbh=connexion() ;
						foreach($dbh->query('SELECT * from utilisateurs where corbeille_user=1') as $row) {
							echo'<tr>';
								echo '<td><a href="single.php?id='.$row['0'].'">'.$row['pseudo_user'].'</a></td>';
								echo '<td>'.$row['nom_user'].' '.$row['prenom_user'].'</td>';
								echo '<td>'.$row['mail_user'].'</td>';
								echo '<td>'.$row['date_creation_user'].'</td>';
								echo '<td>';
									if($row['group_user']=="Admin")echo'Administrateur';
									if($row['group_user']=='Edit')echo'Editeur';
									if($row['group_user']=='Auteur')echo'Auteur';
								echo '</td>';
							echo'</tr>';
						}
						$dbh = null;
					  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include('../includes/footer.php') ?>



<!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>

     <script type="text/javascript">
	 	$('.alert.alert-success.alert-dismissable').css("visibility", "visible");
		
	 </script>
     
