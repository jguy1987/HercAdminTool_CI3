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
      <p class="login-box-msg">Welcome to Hercules Admin Tool! This short installer will get you up and running with
        your panel in just a few steps.</p>
      <?php if (isset($fileError)) { ?>
        <div class="alert alert-danger">
          <h5><i class="icon fas fa-ban"></i> Alert!</h5>
          Failed to write the env file. Make sure the env file is read/writable by your webserver and try again.
        </div>
      <?php } ?>
      <?php if (isset($validation)) { ?>
        <div class="alert alert-warning">
          <h5><i class="icon fas fa-ban"></i> Warning</h5>
          <?php echo $validation->listErrors(); ?>
        </div>
      <?php } ?>
      <form action='<?php echo $actualLink.'/install/step2'; ?>' method="post">
        <div class="input-group mb-3">
          <p>What do you want your panel to be called? This is what the logo will say and how the panel will
            identify itself to your admins in notification emails.</p>
          <input type="text" class="form-control" name='panelName' value="HercAdminTool">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <p>What is your server called? This is how the panel will identify itself in emails to your users.</p>
          <input type="text" class="form-control" name='serverName' value="YourRO">
          <div class="input-group-append">
            <div class="input-group-text">
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Continue</button>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo $actualLink.'/assets/plugins/jquery/jquery.min.js'; ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $actualLink.'/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo $actualLink.'/assets/dist/js/adminlte.min.js'; ?>"></script>

</body>
</html>
