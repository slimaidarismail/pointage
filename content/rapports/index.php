<?php include("../includes/header.php"); ?>
<?php
	synchonisation();
	$crit = $RecDateM = $RecDateY = $groupes_salaries = $jour ="";
	
	$RecDate = date("d/m/Y");
	if(isset($_GET['RecDate']) && isset($_GET['groupes_salaries']))
	{
		$RecDate = $_GET['RecDate'];
		$groupes_salaries = " AND S.id_groupe_salarie=".$_GET['groupes_salaries'];
		$datesDebut = explode("/", trim($RecDate));
		
		$date1 = new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
		$date2 = new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
		$dateTH  =  new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
		
		$date2->modify("+7 day");
		
		$diff = date_diff($date1,$date2);
		$jour = 7;
		
		$arrayJrFeriers[] = "";
		foreach( recuperer_jourFeriers() as $jrFeriers)
		{
			$dates = explode("-", $jrFeriers['du_au']);
			$datesDebut = explode("/", trim($dates[0])); $datesFin = explode("/",trim($dates[1]));
			
			$du = new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
			$au = new DateTime($datesFin[2]."-".$datesFin[1]."-".$datesFin[0]);
			
			$au->modify("+1 day");
			while($du != $au)
			{
        		$back_to_init= clone $du;
				array_push($arrayJrFeriers, array($jrFeriers["nom_jour_ferie"], $back_to_init)); 
				$du->modify("+1 day");
			}
		}

	}
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 >
        Rapport de pointage <?php  echo $RecDate;?> 
      </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">

        <div class="row margin no-print">
        <form action="" method="get">
        	<div class="col-md-2">
            </div>
        	<div class="col-md-3">
            	<div class="form-group">
                	<select class="form-control" name="groupes_salaries" id="groupes_salaries">
            			<?php echo tableToOptionSelect ("groupes_salaries", "id_groupe_salarie", "nom_groupe_salarie","" , $_GET['groupes_salaries']);?>
                    </select>
                </div>
            </div>
        	<div class="col-md-3">
				<div class="form-group">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="RecDate" name="RecDate" value="<?php echo $RecDate ?>">
                    </div>
              	</div>
            </div>
        	<div class="col-md-2">
            	<button class="btn btn-flat btn-facebook btn-block" ><i class="fa fa-filter"></i> Filtrer</button>
            </div>
        </form>
            <div class="col-md-12">
                 <i class="fa fa-circle text-green"></i> Present
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <i class="fa fa-circle text-red"></i> Absent
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <i class="fa fa-circle text-orange"></i> Pointage incomplet 
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <i class="fa fa-circle text-aqua"></i> Retard 
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <i class="fa fa-circle text-gray"></i> Férié 
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <i class="fa fa-circle text-blue"></i> Travail jour férié
                 &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
        <div class="box-body">
        <?php if(isset($_GET['RecDate'])){ ?>
       		
            <div class="table-responsive">
        	<table class="table table-bordered table-hover dataTable " id="dataTable">
            
                  <thead>
					<th>Nom</th>
                    <?php
						for($i = 0 ; $i<= $jour; $i++)
						{
							echo'<th  class="text-center">'. $dateTH->format("d/m") .'</th>';
							$dateTH->modify("+1 day");
						} 
						
					?>
                  </thead>
                  <tbody>
                    <?php 
					$nomComplet =  $newName= $date= $heureS= $heureE=""; $first= true; $firstHeure= true;
					foreach (recuperer_salarie("", $groupes_salaries) as $salarie)
					{ 
					$nomComplet  = $salarie["nom_salarie"]." ".$salarie["prenom_salarie"];
					$dateTD  =  new DateTime( $datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
					
					?>
						<tr>
							<td ><?php echo $nomComplet  ?></td>
                            <?php 
							for($i = 0 ; $i<= $jour; $i++)
							{
								$holidays = false; $labelDay = "";
								$query = " WHERE id_salarie = ". $salarie["id_salarie"]." AND RecDate='".$dateTD->format("Y-m-d")."'" ;
								if($dateTD->format("D") == "Sun") {$labelDay="<small><small>(Dimanche)</small></small>"; $classColor = "bg-gray"; }
								else {$labelDay="<small>Absent</small>";  $classColor = "bg-red";}
								
								foreach($arrayJrFeriers as $aJrF)
								{
									if(!empty($aJrF)){
										if( $aJrF[1]->format("Y-m-d") == $dateTD->format("Y-m-d")  )
										{$labelDay="<small>($aJrF[0])</small>";  $classColor = "bg-gray"; $holidays =true;}
									}
								}
								if(recuperer_pointage($query)->fetch())
								{
									$classColor = "bg-orange";
									$heureE = $heureS = "N.A"; $first = true;
									if(!$holidays)$labelDay ="";
									foreach (recuperer_pointage($query) as $pointage)
									{ 	
										if($first) { $heureE = $pointage["RecTime"]; $first = false;}
										else {$heureS = $pointage["RecTime"]; $classColor = "bg-green"; }
									}
									if(($dateTD->format("D") == "Sun") || $holidays) $classColor = "bg-blue";
									echo "<td  class='$classColor text-center'>$heureE - $heureS"." <small>$labelDay</small></td>";
								}
								else echo "<td class='$classColor text-center'>$labelDay</td>";
								$dateTD->modify("+1 day");
							} 
							?>    
						</tr>
					<?php
					}
					?>
                   </tbody>
            </table>
            </div>
        </div>
        
        <?php } ?>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<!-- Main content -->


<?php include("../includes/footer.php"); ?>
<script type="text/javascript">
   $(document).ajaxStart(function() { Pace.restart(); });
</script>
<script>
	$( document ).ready(function() {
		
		$('#RecDate').datepicker({
			locale: {
				format: 'DD/MM/YYYY'
			},
			autoclose: true
		});
   });
   
</script>


