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
				<li class="list-inline-item notif">
					<i class="fa fa-fw fa-group" data-toggle="tooltip" data-placement="bottom" title="Players Online"></i>: &nbsp; <?php echo $online_users; ?>
				</li>
				<li class="list-inline-item notif">
					<i class="fa fa-fw fa-ticket" data-toggle="tooltip" data-placement="bottom" title="New Tickets"></i>: &nbsp; 2
				</li>
				<li class="list-inline-item notif">
					<i class="fa fa-fw fa-bug" data-toggle="tooltip" data-placement="bottom" title="Assigned Bugs"></i>: &nbsp; 6
				</li>
				<?php 
					$servers = $this->config->item('ragnarok_servers');
					$server = $servers[$this->session->userdata('server_select')]['servername'];
				?>
				<li class="list-inline-item dropdown notif">
					<a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-hdd-o fa-fw"></i> <?php echo $server; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
						<div class="dropdown-item noti-title">
							<h5 class="text-overflow"><small>Server Select</small></h5>
						</div>
						<?php foreach ($servers as $k=>$v) { ?>
							<a href="<?php echo base_url('server/select_server/'.$k.''); ?>" class="dropdown-item notify-item">
								<p class="notify-details ml-0">
									<b><?php echo $v['servername']; ?></b>
									<span>Short description of server here</span>
									<small class="text-muted"><strong>Rates</strong>: 1000/1000</small>
								</p>
							</a>
						<?php } ?>
					</div>
				</li>
				<li class="list-inline-item dropdown notif">
					<a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
						<i class="fa fa-user fa-fw"></i> <?php echo $username; ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<div class="dropdown-item noti-title">
							<h5 class="text-overflow"><small><?php echo $group_list[$this->session_data['group']]; ?></small></h5>
						</div>
						<a href="<?php echo base_url('user/settings'); ?>" class="dropdown-item notify-item"><i class="fa fa-gear fa-fw"></i> Your Settings</a>
						<a href="<?php echo base_url('user/logout'); ?>" class="dropdown-item notify-item"><i class="fa fa-power-off fa-fw"></i> Logout</a>
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