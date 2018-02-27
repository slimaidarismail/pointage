<?php include("../includes/header.php"); ?>
<?php
	synchonisation();
	$crit = $RecDateM = $RecDateY = $groupes_salaries = $jour = $pointages = "";
	
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
		
		$arrayPointage[] = array();
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
      <div class="box box-primary ">
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
						$pointages = 0; $pointages = 0;
					?>
                            <?php 
							for($i = 0 ; $i<= $jour; $i++)
							{
								$query = " WHERE id_salarie = ". $salarie["id_salarie"]." AND RecDate='".$dateTD->format("Y-m-d")."'" ;
								
								if(recuperer_pointage($query)->fetch())
								{
									$first = true; $second = false;  
									foreach (recuperer_pointage($query) as $pointage)
									{ 
										if($first) 
										{
											$second = true; 
											$first = false;
										}
										elseif( $second )
										{
											$pointages++;
											 $second = false;
										}
									}
								}
								$dateTD->modify("+1 day");
							} 
							
							array_push( $arrayPointage, array($nomComplet, $pointages));
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
		//$("#dataTable").DataTable();
		
		$('#RecDate').datepicker({
			locale: {
				format: 'DD/MM/YYYY'
			},
			autoclose: true
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
<style>
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px !important;}
</style>