<?php include("includes/header.php"); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    	<div class="row">
		<div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php echo get_count("salaries")?></h3>
              
              <p>Salariés</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo root ?>salaries/" class="small-box-footer">Liste <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Rapports</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="<?php echo root ?>rapports/" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>&nbsp;</h3>

              <p>Statistiques</p>
            </div>
            <div class="icon">
              <i class="ion-stats-bars"></i>
            </div>
            <a href="<?php echo root ?>statistiques/pointage.php" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("includes/footer.php"); ?>