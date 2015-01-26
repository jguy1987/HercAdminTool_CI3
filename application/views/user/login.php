<html lang="en">

	<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Aesira Online OPTool</title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/plugins/timeline.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/plugins/morris.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">
						<?php echo validation_errors(); ?>
						<?php echo form_open('verifylogin'); ?>
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus />
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="passwd" type="password" value="" />
							</div>
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
						</fieldset>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>