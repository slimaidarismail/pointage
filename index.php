<?php include("includes/header.php"); ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tableau de bord
        <small>it all starts here</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="row">
		<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php echo get_count("salaries")?></h3>
              
              <p>Salariés</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo root ?>salaries/single.php" class="small-box-footer">Ajouter <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo get_count("salaries", "WHERE id_groupe_salarie = 1")?> </h3>

              <p>Administration</p>
            </div>
            <div class="icon">
              <i class="fa fa-pencil-square-o "></i>
            </div>
            <a href="<?php echo root ?>salaries/?s=administration" class="small-box-footer">Plus de détails <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-navy">
            <div class="inner">
              <h3><?php echo get_count("salaries", "WHERE id_groupe_salarie = 2")?> </h3>

              <p>Enseignant - primaire</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="<?php echo root ?>salaries/?s=enseignants" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo get_count("salaries", "WHERE id_groupe_salarie = 3")?> </h3>

              <p>Professeurs</p>
            </div>
            <div class="icon">
              <i class="fa fa-briefcase"></i>
            </div>
            <a href="<?php echo root ?>salaries/?s=professeurs" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php echo get_count("salaries", "WHERE id_groupe_salarie = 4")?> </h3>

              <p>Femmes de menage</p>
            </div>
            <div class="icon">
              <i class="fa fa-female"></i>
            </div>
            <a href="<?php echo root ?>salaries/?s=femmes-de-menage" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?php echo get_count("jours_feries")?> </h3>

              <p>Les jours fériés</p>
            </div>
            <div class="icon">
              <i class="fa fa-star"></i>
            </div>
            <a href="<?php echo root ?>feries" class="small-box-footer">Plus de details <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include("includes/footer.php"); ?>