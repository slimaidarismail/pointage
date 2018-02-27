<?php session_start(); ?>
<?php include("config.php")?>
<?php if(!isset($_SESSION['code_user'])) echo '<script>document.location.href="'.root.'connexion/"</script>';?>
<?php include("functions.php")?>
<?php synchonisation();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WE-Pointage | Gestion APP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo root; ?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo root; ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo root; ?>assets/dist/css/skins/_all-skins.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo root; ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo root; ?>assets/plugins/datepicker/datepicker3.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition sidebar-mini skin-blue">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <a href="<?php echo root ?>" class="">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini hidden"><b class="text-orange">WE</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <img src="<?php echo root; ?>assets/dist/img/logo.png" alt="logo" width="200" class="logo-lg">
    </a>
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="treeview">
          <a href="<?php echo root ?>">
            <i class="fa fa-cogs"></i> <span>Menu principal</span>
          </a>
        </li>
        <li class="treeview">
          <a href="salaries">
            <i class="fa fa-users"></i>
            <span>Salariés</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo root ?>salaries"><i class="fa fa-users"></i> Tout les salariés</a></li>
            <li><a href="<?php echo root ?>salaries/?s=administration"><i class="fa fa-pencil-square-o "></i> Administration</a></li>
            <li><a href="<?php echo root ?>salaries/?s=enseignants"><i class="fa fa-briefcase"></i> Enseignant - primaire</a></li>
            <li><a href="<?php echo root ?>salaries/?s=professeurs"><i class="fa fa-briefcase"></i> Professeurs</a></li>
            <li><a href="<?php echo root ?>salaries/?s=femmes-de-menage"><i class="fa fa-female"></i> Femmes de menage</a></li>
            <li><a href="<?php echo root ?>salaries/?s=it-informatique"><i class="fa fa-keyboard-o"></i> IT Informatique</a></li>
          </ul>
        </li>
        <li class="">
          <a href="<?php echo root ?>rapports">
            <i class="fa fa-file"></i>
            <span>Rapport hebdomadaire</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Statistiques</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo root ?>statistiques/pointage.php"><i class="fa fa-circle-o"></i> Pointage</a></li>
            <li><a href="<?php echo root ?>statistiques/retards.php"><i class="fa fa-circle-o"></i> Retards</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="<?php echo root?>utilisateurs/single.php?id=<?php echo $_SESSION['code_user']?>">
            <i class="fa fa-user"></i>
            <span>Mon Compte</span>
          </a>
        </li>
		<li class="treeview">
          <a href="<?php echo root?>includes/logout.php">
            <i class="fa fa-lock"></i>
            <span>Déconnexion</span>
          </a>
        </li>
      </ul>
    </section>
    <img src="<?php echo root; ?>assets/dist/img/logo1.png" class="img-responsive" style="bottom:10px; position:absolute">
    <!-- /.sidebar -->
  </aside>