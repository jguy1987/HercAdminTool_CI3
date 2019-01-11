<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="John Mish" >

	<title>HercAdminTool Error Encountered</title>

	<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/plugins/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/plugins/timeline.css'); ?>" rel="stylesheet">
	<link href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet">
	<link href="<?php echo base_url('assets/font-awesome-4.1.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/plugins/bootstrap-datetimepicker.css'); ?>" rel="stylesheet">
	<!--<link href="<?php echo base_url('assets/css/plugins/dataTables/dataTables.bootstrap.css'); ?>" rel="stylesheet"> -->
	<link href="<?php echo base_url('assets/css/sb-admin-2.css'); ?>" rel="stylesheet">

	<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/metisMenu/metisMenu.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/sb-admin-2.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/bootstrap-datetimepicker.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>
	
</head>
<body>
	<div id="wrapper">
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger" role="alert">
						<?php 
						switch($errtype) {
							case "nobaseurl":
								echo "<h4 class='alert-heading'>Configuration Error!</h4>";
								echo "<p>You have not set a base URL! Please ensure you have set the 'base_url' setting correctly.</p>";
								echo "<p>For example: because you have not set this very important setting, this error message should be red in color. But it's not :(</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/config.php</p>";
								echo "<p><strong>Line(s)</strong>: 26</p>";
								break;
							case "noenckey":
								echo "<h4 class='alert-heading'>Configuration Error!</h4>";
								echo "<p>You have not set an encryption key! Please ensure you have set the 'encryption_key' setting correctly.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/config.php</p>";
								echo "<p><strong>Line(s)</strong>: 327</p>";
								break;
							case "hatdbconn":
								echo "<h4 class='alert-heading'>HAT Database Connection Error!</h4>";
								echo "<p>The application was not able to make a connection to your HAT database. Please check your database configuration in the 'hat' database group for the correct information.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/database.php</p>";
								echo "<p><strong>Line(s)</strong>: 65-85</p>";
								break;
							case "logindbconn":
								echo "<h4 class='alert-heading'>Login Database Connection Error!</h4>";
								echo "<p>The application was not able to make a connection to your Login database. Please check your database configuration in the appropriate database group for the correct information.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/database.php</p>";
								echo "<p><strong>See also</strong>: Configuration in application/config/hat.php</p>";
								break;
							case "charmapdbconn":
								echo "<h4 class='alert-heading'>Char/Map Database Connection Error!</h4>";
								echo "<p>The application was not able to make a connection to your Char/Map Server database. Please check your database configuration in the appropriate database group for the correct information.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/database.php</p>";
								echo "<p><strong>See also</strong>: Configuration in application/config/hat.php</p>";
								break;
							case "logdbconn":
								echo "<h4 class='alert-heading'>Log Database Connection Error!</h4>";
								echo "<p>The application was not able to make a connection to your Log database. Please check your database configuration in the appropriate database group for the correct information.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/database.php</p>";
								echo "<p><strong>See also</strong>: Configuration in application/config/hat.php</p>";
								break;
							case "invalidservername":
								echo "<h4 class='alert-heading'>Invalid Server Name!</h4>";
								echo "<p>You have set a char/map 'map_servername' in hat.php that does not exist in your database!</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: application/config/hat.php</p>";
								break;
							case "hattables":
								echo "<h4 class='alert-heading'>HAT Tables not foundd</h4>";
								echo "<p>It appears that your HAT Database connection is good, but none of the tables were found. Please make sure the entire file in /docs/sql/hat.sql has been loaded into your database.</p>";
								echo "<hr>";
								echo "<p><strong>File</strong>: docs/sql/hat.sql</p>";
								echo "<p><strong>See also</strong>: application/config/database.php</p>";
								break;
							default:
								echo "<h4 class='alert-heading'>Generic Application Failure!</h4>";
								echo "<p>The application has failed. Please submit a bugreport as to what you were doing or trying to do when you saw this error.</p>";
						} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>