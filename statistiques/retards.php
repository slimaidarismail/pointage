<?php include("../includes/header.php"); ?>
<?php
	synchonisation();
	$crit = $RecDateM = $RecDateY = $groupes_salaries = $jour = $pointages = "";
	
	$RecDate = "";
	if(isset($_GET['RecDate']) && isset($_GET['groupes_salaries']))
	{
		$RecDate = $_GET['RecDate'];
		$groupes_salaries = " AND S.id_groupe_salarie=".$_GET['groupes_salaries'];
		$dates = explode("-", $RecDate);
		$datesDebut = explode("/", trim($dates[0])); $datesFin = explode("/",trim($dates[1]));
		
		$date1 = new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
		$date2 = new DateTime($datesFin[2]."-".$datesFin[1]."-".$datesFin[0]);
		$dateTH  =  new DateTime($datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
			
		$diff = date_diff($date1,$date2);
		$jour = $diff->format("%a");
		
		$arrayPointage[] = array();
		
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
          <h3 class="box-title  no-print"><i class="glyphicon glyphicon-hand-up"></i> Pointage</h3>
          <div class="box-tools pull-right  no-print">
             <a class="btn-xs text-green export" id="listDownload"><i class="fa fa-file-excel-o"></i> Excel</a>
             <a class="btn-xs text-black" href="javascript:window.print()"><i class="fa fa-print"></i> Imprimer</a>
          </div>
		<h4 class="visible-print-inline-block">
			Rapport de pointage <?php  echo $RecDate;?> 
		</h4>
   		<img src="<?php echo root; ?>assets/dist/img/logo1.png" class="visible-print-inline-block pull-right" style="">
        </div>
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
            	<button class="btn btn-flat btn-warning btn-block" ><i class="fa fa-filter"></i> Filtrer</button>
            </div>
        </form>
        </div>
        <div class="box-body">

        <?php if(isset($_GET['RecDate'])){ ?>
			<div class="chart">
				<canvas id="barChart" style="height:230px"></canvas>

                    <?php 
					foreach (recuperer_salarie("", $groupes_salaries) as $salarie)
					{ 
						$nomComplet  = $salarie["nom_salarie"]." ".$salarie["prenom_salarie"];
						$dateTD  =  new DateTime( $datesDebut[2]."-".$datesDebut[1]."-".$datesDebut[0]);
						$pointages = 0;
					?>
                            <?php 
							for($i = 0 ; $i<= $jour; $i++)
							{
								$query = " WHERE id_salarie = ". $salarie["id_salarie"]." AND RecDate='".$dateTD->format("Y-m-d")."'" ;
								$holidays = false; $labelDay = "";
								foreach($arrayJrFeriers as $aJrF)
								{
									if(!empty($aJrF)){
										if( $aJrF[1]->format("Y-m-d") == $dateTD->format("Y-m-d")  )
										{$labelDay="<small>($aJrF[0])</small>";  $classColor = "bg-gray"; $holidays =true;}
									}
								}
								if(recuperer_pointage($query)->fetch())
								{
									$first = true; $second = false; $retard = false;
									foreach (recuperer_pointage($query) as $pointage)
									{ 
										if($first && !$holidays && ($dateTD->format("D") != "Sun")) 
										{
											$testTime = explode(":", $pointage['RecTime']);
											if(intval($testTime[0])>8) $pointages++; 
											elseif((intval($testTime[0])==8) && (intval($testTime[1])>20)) $pointages++; 
											$first =false;
										}
										
									}
								}
								$dateTD->modify("+1 day");
							} 
							
							array_push( $arrayPointage, array($nomComplet, $pointages))
							?>
					<?php
					}
					?>
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
		$(".export").on('click', function (event) {
			exportTableToCSV.call(this, $('table'), 'Salaries.csv');
		});
		//$("#dataTable").DataTable();
		
		$('#RecDate').daterangepicker({
			locale: {
				format: 'DD/MM/YYYY'
			}
		});
   });
   
</script>
<script>

 var areaChartData = {
      labels: [ <?php $first = true; foreach($arrayPointage as $ap) {if(!empty($ap)){if(!$first) echo ', ';echo '"'.$ap[0].'" ';$first = false;}}?>],
      datasets: [
        {
          label: "Nombre de pointage",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [ <?php $first = true; foreach($arrayPointage as $ap) {if(!empty($ap)){if(!$first) echo ', ';echo '"'.$ap[1].'" ';$first = false;}}?>]
        }
      ]
    };
	
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
		isFixedWidth:false,
lineWidth: 10,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
</script>
