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
				<!-- /input-group -->
			</li>
			<li>
				<a href="http://admin.aesiraonline.com"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			</li>
			<li>
				<a href="#"><i class="fa fa-fw"></i> Accounts<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/account/listaccts">List/Search Accounts</a>
					</li>
					<?php if ($check_perm['addaccount'] == 1) { ?>
						<li>
							<a href="/account/create">Create New</a>
						</li>
					<?php } ?>
				</ul>
				<!-- /.nav-second-level -->
			</li>
			<li>
				<a href="#"><i class="fa fa-fw"></i> Characters<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li>
						<a href="/character/listchars">List/Search Characters</a>
					</li>
					<li>
						<a href="/character/whosonline">View Online</a>
					</li>
				</ul>
			</li>
			<?php if ($check_perm['atcmdlog'] == 1 || $check_perm['branchlog'] == 1 || $check_perm['chatlog'] == 1 || $check_perm['loginlog'] == 1 || $check_perm['mvplog'] == 1 || $check_perm['npclog'] == 1 || $check_perm['picklog'] == 1 || $check_perm['zenylog'] == 1) { ?>
				<li>
					<a href="#"><i class="fa fa-fw"></i> Game Logs<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<?php if ($check_perm['atcmdlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/atcmd/search">@command</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['branchlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/branch/search">branch</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['chatlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/chat/search">chat</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['loginlog'] == 1) { ?>
							<li>
								<a href="/gamelogs/login/search">login</a>
							</li>	
						<?php } ?>
						<?php if ($check_perm['mvplog'] == 1) { ?>
							<li>
								<a href="/gamelogs/mvp/search">mvp</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['npclog'] == 1) { ?>
							<li>
								<a href="/gamelogs/npc/search">npc</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['picklog'] == 1) { ?>
							<li>
								<a href="/gamelogs/pick/search">pick</a>
							</li>
						<?php } ?>									
						<?php if ($check_perm['zenylog'] == 1) { ?>								
							<li>
								<a href="/gamelogs/zeny/search">zeny</a>
							</li>	
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			<?php if ($check_perm['items'] == 1 || $check_perm['itemshop'] == 1 || $check_perm['mobs'] == 1 || $check_perm['sftp'] == 1 || $check_perm['serverconfig'] == 1) { ?>
				<li>
					<a href="#"><i class="fa fa-fw"></i> Server Setup<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level">
						<?php if ($check_perm['items'] == 1) { ?>
							<li>
								<a href="/serversetup/itemdb">Item Database</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['itemshop'] == 1) { ?>
							<li>
								<a href="/serversetup/itemshop">Item Shop</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['mobs'] == 1) { ?>
							<li>
								<a href="/serversetup/mobdb">Mob Database</a>
							</li>
						<?php } ?>
						<?php if ($check_perm['sftp'] == 1) { ?>
							<li>
								<a href="/serversetup/stfp">SFTP Access</a>
							</li>	
						<?php } ?>
						<?php if ($check_perm['serverconfig'] == 1) { ?>
							<li>
								<a href="/serversetup/config">Server Configuration</a>
							</li>
						<?php } ?>
					</ul>
				</li>
			<?php } ?>
			<?php if ($check_perm['editadmin'] == 1 || $check_perm['editgroups'] == 1) { ?>
			<li>
				<a href="#"><i class="fa fa-fw"></i> Panel Admin<span class="fa arrow"></span></a>
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
					<li>
						<a href="/admin/logs">Log Management</a>
					</li>	
				</ul>
			</li>
			<?php } ?>
		</ul>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>
