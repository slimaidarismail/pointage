<?php
session_start();
include('../includes/config.php');
include('../includes/functions.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>WE-Pointage | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo root ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo root ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="<?php echo root ?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-page">
    <div class="login-box">
      <div class="login-logo"><img src="<?php echo root; ?>assets/dist/img/logo.png" alt="logo" class="logo-lg img-responsive"></div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Connectez-vous pour commencer</p>
        <form action="#" method="post">
          <div class="form-group ">
            <input type="text" id="mail_user" name="mail_user" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group ">
            <input type="password" id="mdp_user" name="mdp_user"  class="form-control" autocomplete="off" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class=" margin">
              <button type="submit" name="connexion" class="btn btn-warning btn-block btn-flat"><i class="fa fa-lock"></i> Connexion</button>
            </div><!-- /.col -->
          </div>
        </form><!-- /.social-auth-links -->

        <a href="#" style="display:none; visibility:hidden">Mot de passe oublié</a><br>
		<div class="alert alert-warning" style=" display:none" id="login_warning">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    	<h4><i class="fa fa-warning"></i> Alert</h4>Informations de connexion incorrectes. Veuillez vérifier vos informations et réessayer.</div>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo root ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo root ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="<?php echo root ?>assets/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    <?php

if (isset($_POST['connexion'])) {
    $dbh       = connexion();
    $mail_user = $_POST['mail_user'];
    $mdp_user  = $_POST['mdp_user'];
    
    foreach ($dbh->query("SELECT * from utilisateurs where mail_user='" . $mail_user . "' and mdp_user='" . md5($mdp_user) . "'") as $row) {
        $_SESSION['inserttion'] = ' ';
        
        $_SESSION['nom_complet'] = $row['nom_user'] . ' ' . $row['prenom_user'];
        if ($row['group_user'] == "Admin") {
            $group_user = 'Administrateur';
        }
        $_SESSION['group']         = $group_user;
        $date                      = explode($row['date_creation_user'], '-');
        $_SESSION['creation_user'] = $row['date_creation_user'];
        $_SESSION['code_user']     = $row[0];
        $_SESSION['picture_user']	= root.$row['picture_user'];
        
        
        $_SESSION['banir'] = 0;
        $dbh               = null;
        echo '<script>document.location.href="'.root.'"</script>';
    }
    
/*    if ($_SESSION['banir'] != 0) {
        echo '<script type="text/javascript">$("#login_warning").css("display", "block");</script>';
        
        $dbh        = connexion();
        $ip_user    = $_SERVER['REMOTE_ADDR'];
        $date_banir = date('d/m/Y');
        $stmt       = $dbh->prepare("INSERT INTO banir_users (ip_user, date_banir) VALUES (:ip_user, :date_banir)");
        $stmt->bindParam(':ip_user', $ip_user);
        $stmt->bindParam(':date_banir', $date_banir);
        
        $stmt->execute();
        $dbh = null;
    }
    $_SESSION['banir'] += 1;*/
}
?>
  </body>
</html>