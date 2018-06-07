<body class="adminbody">
<div id="main">
	<!-- top bar navigation -->
	<div class="headerbar">
		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="<?php echo $this->config->item('base_url'); ?>" class="logo"><span><?php echo $this->config->item('panelname'); ?></span></a>
        </div>
		<nav class="navbar-custom">
			<ul class="list-inline float-right mb-0">
				<li class="list-inline-item notif hidden-sm-down">
					<i class="fa fa-fw fa-group" data-toggle="tooltip" data-placement="bottom" title="Players Online"></i>: &nbsp; <?php echo $this->playersonline; ?>
				</li>
				<li class="list-inline-item notif hidden-sm-down">
					<i class="fa fa-fw fa-ticket" data-toggle="tooltip" data-placement="bottom" title="New Tickets"></i>: &nbsp; 2
				</li>
				<li class="list-inline-item notif hidden-sm-down">
					<i class="fa fa-fw fa-bug" data-toggle="tooltip" data-placement="bottom" title="Assigned Bugs"></i>: &nbsp; 6
				</li>
				<li class="list-inline-item dropdown notif">
					<a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-user fa-fw"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<div class="dropdown-item noti-title">
							<h5 class="text-overflow"><small><?php echo $username; ?></small></h5>
						</div>
						<a href="<?php echo base_url('user/settings'); ?>" class="dropdown-item notify-item"><i class="fa fa-gear fa-fw"></i> <span>Your Settings</span></a>
						<a href="<?php echo base_url('user/logout'); ?>" class="dropdown-item notify-item"><i class="fa fa-power-off fa-fw"></i> <span>Logout</span></a>
					</div>
				</li>
			</ul>
			<ul class="list-inline menu-left mb-0">
				<li class="float-left">
					<button class="button-menu-mobile open-left">
						<i class="fa fa-fw fa-bars"></i>
					</button>
				</li>                        
			</ul>
		</nav>
	</div>