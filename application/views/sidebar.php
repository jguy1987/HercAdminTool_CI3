<div class="left main-sidebar">
	<div class="sidebar-inner leftscroll">
		<div id="sidebar-menu">
			<ul>
				<li class="submenu">
					<a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-fw"></i><span> Dashboard </span> </a>
				</li>
				<?php if ($check_perm['viewaccounts'] == 1 || $check_perm['addaccount'] == 1) { ?>
					<?php if ($vacation == 0) { ?>
						<li class="submenu">
							<a href="javascript:;"><i class="fa fa-user fa-fw"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<?php if ($check_perm['viewaccounts'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('account/search'); ?>">Search Accounts</a></li>
								<?php } ?>
								<?php if ($check_perm['addaccount'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('account/create'); ?>">Create New</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
				<?php if ($check_perm['viewchars'] == 1 || $check_perm['whosonline'] == 1) { ?>
					<li class="submenu">
						<a href="javascript:;"><i class="fa fa-user fe-fw"></i> <span> Characters </span> <span class="menu-arrow"></span></a>
						<ul class="list-unstyled">
							<?php if ($check_perm['viewchars'] == 1 && $vacation == 0) { ?>
								<li><a href="<?php echo base_url('character/search'); ?>">Search Characters</a></li>
							<?php } ?>
							<?php if ($check_perm['whosonline'] == 1) { ?>
								<li><a href="<?php echo base_url('character/whosonline'); ?>">View Online</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				<?php if ($check_perm['viewguilds'] == 1 || $check_perm['managecastles'] == 1) { ?>
					<?php if ($vacation == 0) { ?>
						<li class="submenu">
							<a href="javascript:;"><i class="fa fa-users fa-fw"></i> <span> Guilds </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<?php if ($check_perm['viewguilds'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('guild/listguilds'); ?>">List/Search Guilds</a></li>
								<?php } ?>
								<?php if ($check_perm['managecastles'] == 1 || $vacation == 0) { ?>
									<li><a href="<?php echo base_url('guild/castles'); ?>">Manage Castles</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
				<?php if ($check_perm['atcmdlog'] == 1 || $check_perm['branchlog'] == 1 || $check_perm['chatlog'] == 1 || $check_perm['loginlog'] == 1 || $check_perm['mvplog'] == 1 || $check_perm['npclog'] == 1 || $check_perm['picklog'] == 1 || $check_perm['zenylog'] == 1) { ?>
					<?php if ($vacation == 0) { ?>
						<li class="submenu">
							<a href="javascript:;"><i class="fa fa-list-ol fa-fw"></i> <span> Game Logs </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<?php if ($check_perm['atcmdlog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/atcmd_search'); ?>">@command</a></li>
								<?php } ?>
								<?php if ($check_perm['branchlog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/branch'); ?>">branch</a></li>
								<?php } ?>
								<?php if ($check_perm['chatlog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/chat'); ?>">chat</a></li>
								<?php } ?>
								<?php if ($check_perm['loginlog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/login'); ?>">login</a></li>	
								<?php } ?>
								<?php if ($check_perm['mvplog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/mvp'); ?>">mvp</a></li>
								<?php } ?>
								<?php if ($check_perm['npclog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/npc'); ?>">npc</a></li>
								<?php } ?>
								<?php if ($check_perm['picklog'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('gamelogs/pick_search'); ?>">pick</a></li>
								<?php } ?>									
								<?php if ($check_perm['zenylog'] == 1 && $vacation == 0) { ?>								
									<li><a href="<?php echo base_url('gamelogs/zeny_search'); ?>">zeny</a></li>	
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
				<?php if ($check_perm['itemshop'] == 1 || $check_perm['serverconfig'] == 1) { ?>
					<li class="submenu">
						<a href="javascript:;"><i class="fa fa-wrench fa-fw"></i> <span> Server Administration </span> <span class="menu-arrow"></span></a>
						<ul class="list-unstyled">
							<?php if ($ssh_conn == 1) { ?>
							<li><a href="<?php echo base_url('server/hercules'); ?>">Server Maintenance</a></li>
							<?php } ?>
							<?php if ($check_perm['itemshop'] == 1 && $vacation == 0) { ?>
								<li><a href="<?php echo base_url('server/itemshop'); ?>">Item Shop</a></li>
							<?php } ?>
							<?php if ($check_perm['serverconfig'] == 1 && $vacation == 0) { ?>
								<li><a href="<?php echo base_url('server/config'); ?>">Server Configuration</a></li>
							<?php } ?>
							<?php if ($check_perm['announcement'] == 1) { ?>
								<li><a href="<?php echo base_url('server/broadcast'); ?>">Server Broadcasts</a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				<?php if ($check_perm['items'] == 1 || $check_perm['mobs'] == 1 || $check_perm['sftp'] == 1 || $check_perm['viewbugs'] == 1) { ?>
					<?php if ($vacation == 0) { ?>
						<li class="submenu">
							<a href="javascript:;"><i class="fa fa-code-fork fa-fw"></i> <span> Developer </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<?php if ($check_perm['viewbugs'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('bugtracker/buglist'); ?>">Bugtracker</a></li>
								<?php } ?>
								<?php if ($check_perm['items'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('server/itemdb'); ?>">Item Database</a></li>
								<?php } ?>
								<?php if ($check_perm['mobs'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('server/mobdb'); ?>">Mob Database</a></li>
								<?php } ?>
								<?php if ($check_perm['sftp'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('server/stfp'); ?>">SFTP Access</a></li>	
								<?php } ?>	
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
				<?php if ($check_perm['level1zeny'] == 1 || $check_perm['nocharaccts'] == 1 || $check_perm['delcharsaccts'] == 1 || $check_perm['top100'] == 1 || $check_perm['mvpkill'] == 1 || $check_perm['itemcount'] == 1) { ?>
					<?php if ($vacation == 0) { ?>
						<li class="submenu">
							<a href="javascript:;"><i class="fa fa-filter fa-fw"></i> <span> Server Analysis </span> <span class="menu-arrow"></span></a>
							<ul class="list-unstyled">
								<?php if ($check_perm['itemcount'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/itemcount'); ?>">Item Count by character</a></li>
								<?php } ?>
								<?php if ($check_perm['level1zeny'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/level1zeny'); ?>">Level 1 Characters > 1m zeny</a></li>
								<?php } ?>
								<?php if ($check_perm['nocharaccts'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/nocharaccts'); ?>">Accounts with no characters</a></li>
								<?php } ?>
								<?php if ($check_perm['delcharsaccts'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/delchars'); ?>">Accounts with deleted characters</a></li>
								<?php } ?>
								<?php if ($check_perm['top100'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/top100'); ?>">Top100 Characters by parameter</a></li>
								<?php } ?>
								<?php if ($check_perm['mvpkill'] == 1 && $vacation == 0) { ?>
									<li><a href="<?php echo base_url('analysis/mvpkill'); ?>">MVP Kill amount</a></li>
								<?php } ?>
							</ul>
						</li>
					<?php } ?>
				<?php } ?>
				<?php if ($check_perm['editadmin'] == 1 || $check_perm['editgroups'] == 1) { ?>
					<li class="submenu">
						<a href="javascript:;"><i class="fa fa-user-circle fa-fw"></i> <span> Panel Administration </span> <span class="menu-arrow"></span></a>
						<ul class="list-unstyled">
							<?php if ($check_perm['editadmin'] == 1) { ?>
							<li><a href="<?php echo base_url('admin/users'); ?>">User Management</a></li>
							<?php } ?>
							<?php if ($check_perm['editgroups'] == 1) { ?>
							<li><a href="<?php echo base_url('admin/groups'); ?>">Group Management</a></li>
							<?php } ?>
							<?php if ($check_perm['editadminnews'] == 1) { ?>
							<li><a href="<?php echo base_url('admin/news'); ?>">News Management</a></li>
							<?php } ?>
							<?php if ($check_perm['viewadminlogs'] == 1) { ?>
							<li><a href="<?php echo base_url('admin/logs'); ?>">Log Management</a></li>	
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
				<br /><br /><br />
				<?php 
					$servers = $this->config->item('ragnarok_servers');
					$server = $servers[$this->session->userdata('server_select')]['servername'];
				?>
				<li class="submenu">
					<a class="pro" href="javascript:;"><i class="fa fa-server fa-fw"></i> <span> <?php echo $server; ?> </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<?php foreach ($servers as $k=>$v) { ?>
							<li><a href="<?php echo base_url('server/select_server/'.$k.''); ?>"><?php echo $v['servername']; ?></a></li>
						<?php } ?>
					</ul>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>