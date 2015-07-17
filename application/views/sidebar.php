<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>"><i class="fa fa-home fa-fw"></i> Dashboard</a>
			</li>
			<?php if ($check_perm['serverstats'] == 1) { ?>
				<li>
					<a href="/server/stats"><i class="fa fa-dashboard fa-fw"></i> Server Performance</a>
				</li>
			<?php } ?>
			<li>
				<a href="#"><i class="fa fa-user fa-fw"></i> Accounts<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/account/search">List/Search Accounts</a>
					</li>
					<?php if ($check_perm['addaccount'] == 1) { ?>
						<li>
							<a href="/account/create">Create New</a>
						</li>
					<?php } ?>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-male fa-female fa-fw"></i> Characters<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/character/search">List/Search Characters</a>
					</li>
					<?php if ($check_perm['whosonline'] == 1) { ?>
					<li>
						<a href="/character/whosonline">View Online</a>
					</li>
					<?php } ?>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-users fa-fw"></i> Guilds<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/guild/listguilds">List/Search Guilds</a>
					</li>
					<li>
						<a href="/guild/castles">Manage Castles</a>
					</li>
				</ul>
			</li>
			<?php if ($check_perm['atcmdlog'] == 1 || $check_perm['branchlog'] == 1 || $check_perm['chatlog'] == 1 || $check_perm['loginlog'] == 1 || $check_perm['mvplog'] == 1 || $check_perm['npclog'] == 1 || $check_perm['picklog'] == 1 || $check_perm['zenylog'] == 1) { ?>
				<li>
					<a href="#"><i class="fa fa-list-ol fa-fw"></i> Game Logs<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<?php if ($check_perm['atcmdlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/atcmd">@command</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['branchlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/branch">branch</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['chatlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/chat">chat</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['loginlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/login">login</a>
							</li>	
						<?php } ?>
						<?php if ($check_perm['mvplog'] == 1) { ?>
							<li>
								<a href="/gamelogs/mvp">mvp</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['npclog'] == 1) { ?>
							<li>
								<a href="/gamelogs/npc">npc</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['picklog'] == 1) { ?>
							<li>
								<a href="/gamelogs/pick">pick</a>
							</li>
						<?php } ?>									
						<?php if ($check_perm['zenylog'] == 1) { ?>								
							<li>
								<a href="/gamelogs/zeny">zeny</a>
							</li>	
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			<?php if ($check_perm['items'] == 1 || $check_perm['itemshop'] == 1 || $check_perm['mobs'] == 1 || $check_perm['sftp'] == 1 || $check_perm['serverconfig'] == 1) { ?>
				<li>
					<a href="#"><i class="fa fa-hdd-o fa-fw"></i> Server Setup<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<li>
							<a href="/server/hercules">Hercules Info/Maintenance</a>
						</li>
						<?php if ($check_perm['items'] == 1) { ?>
							<li>
								<a href="/server/itemdb">Item Database</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['itemshop'] == 1) { ?>
							<li>
								<a href="/server/itemshop">Item Shop</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['mobs'] == 1) { ?>
							<li>
								<a href="/server/mobdb">Mob Database</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['sftp'] == 1) { ?>
							<li>
								<a href="/server/stfp">SFTP Access</a>
							</li>	
						<?php } ?>
						<?php if ($check_perm['serverconfig'] == 1) { ?>
							<li>
								<a href="/server/config">Server Configuration</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			<?php if ($check_perm['editadmin'] == 1 || $check_perm['editgroups'] == 1) { ?>
			<li>
				<a href="#"><i class="fa fa-user-md fa-fw"></i> Panel Admin<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<?php if ($check_perm['editadmin'] == 1) { ?>
					<li>
						<a href="/admin/users">User Management</a>
					</li>
					<?php } ?>
					<?php if ($check_perm['editgroups'] == 1) { ?>
					<li>
						<a href="/admin/groups">Group Management</a>
					</li>
					<?php } ?>
					<?php if ($check_perm['editadminnews'] == 1) { ?>
					<li>
						<a href="/admin/news">News Management</a>
					</li>
					<?php } ?>
					<?php if ($check_perm['viewadminlogs'] == 1) { ?>
					<li>
						<a href="/admin/logs">Log Management</a>
					</li>	
					<?php } ?>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
</nav>
