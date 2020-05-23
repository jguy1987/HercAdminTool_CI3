<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    // Try to autodetect the base_url
    $actualLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  ?>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $actualLink.'/assets/plugins/fontawesome-free/css/all.min.css'; ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $actualLink.'/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $actualLink.'/assets/dist/css/adminlte.min.css'; ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Herc</b>AdminTool</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <?php if (isset($validation)) { ?>
        <div class="alert alert-warning">
          <h5><i class="icon fas fa-ban"></i> Warning</h5>
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>
      <p><strong>Installation Finished! Please click below to login to the control panel with the user you just created.</strong></p>
      <a href=<?php echo $actualLink."/user/login"; ?>><button type="button" class="btn btn-primary btn-block">Finish</button></a>
    </div>
  </div>
</div>
<!-- /.login-box -->

<!--- checkProto disables some fields based on the mail protocol selected. -->

<!-- jQuery -->
<script src="<?php echo $actualLink.'/assets/plugins/jquery/jquery.min.js'; ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $actualLink.'/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo $actualLink.'/assets/dist/js/adminlte.min.js'; ?>"></script>

</body>
</html>
