<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="John Mish" >

	<title><?php echo $this->config->item('panelname'); ?></title>

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
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo $this->config->item('base_url'); ?>">HercAdminTool</a>
			</div>
			<ul class="nav navbar-top-links navbar-right">
				Welcome, <strong><?php echo $username; ?></strong>! You are logged in as <strong><?php echo $group_list[$this->session_data['group']]; ?></strong>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<?php 
							$servers = $this->config->item('ragnarok_servers');
							$server = $servers[$this->session->userdata('server_select')]['servername'];
						?>
						<i class="fa fa-hdd-o fa-fw"></i> <?php echo $server; ?> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu">
						<?php foreach ($servers as $k=>$v) { ?>
							<li>
								<a href="/server/select_server/<?php echo $k; ?>">
									<div>
										<?php echo $v['servername']; ?>
									</div>
								</a>
							</li>
						<?php } ?>
					</ul>
				</li>
				<!--<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-alerts">
						<li>
							<a href="#">
								<div>
									<i class="fa fa-comment fa-fw"></i> New Comment
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
							<div>
								<i class="fa fa-twitter fa-fw"></i> 3 New Followers
								<span class="pull-right text-muted small">12 minutes ago</span>
							</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-envelope fa-fw"></i> Message Sent
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-tasks fa-fw"></i> New Task
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="#">
								<div>
									<i class="fa fa-upload fa-fw"></i> Server Rebooted
									<span class="pull-right text-muted small">4 minutes ago</span>
								</div>
							</a>
						</li>
						<li class="divider"></li>
						<li>
							<a class="text-center" href="#">
								<strong>See All Alerts</strong>
								<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
				</li> -->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-user fa-fw"></i> <?php echo $username; ?> <i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<a href="/user/settings"><i class="fa fa-gear fa-fw"></i> Your Settings</a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="/user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
					</ul>
				</li>
			</ul>