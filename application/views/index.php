<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Dashboard</h1>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item active">Dashboard</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
					<div class="card mb-3">
						<div class="card-header">
							<h3><i class="fa fa-info-circle"></i> Server Information</h3>
						</div>
						<div class="card-body">
							<table class="table table-responsive-xl table-striped">
								<tbody>
									<tr>
										<th scope="row">Server Name</th>
										<td><?php echo $servername; ?></td>
									</tr>
									<tr>
										<th scope="row">Hercules Uptime</th>
										<td><?php echo $herc_stats['hercUptime']; ?></td>
									</tr>
									<tr>
										<th scope="row">Users Online</th>
										<td><?php echo $herc_stats['onlineNum']; ?></td>
									</tr>
									<tr>
										<th scope="row">Accounts Registered</th>
										<td><?php echo $herc_stats['acctsNum']; ?></td>
									</tr>
									<tr>
										<th scope="row">Characters Created</th>
										<td><?php echo $herc_stats['charsNum']; ?></td>
									</tr>
									<tr>
										<th scope="row">Guilds Established</th>
										<td><?php echo $herc_stats['guildsNum']; ?></td>
									</tr>
									<tr>
										<th scope="row">Characters in Guilds</th>
										<td><?php echo $herc_stats['guildsCharsNum']; ?></td>
									</tr>
									<tr>
										<th scope="row">Zeny in Circulation</th>
										<td><?php echo $herc_stats['zenyNum']; ?></td>
									</tr>
									<tr>
										<th scope="row"></th>
										<td></td>
									</tr>
									<tr>
										<th scope="row">Server Hostname</th>
										<td><?php echo $server_performance['name']; ?></td>
									</tr>
									<tr>
										<th scope="row">Server Boot Time</th>
										<td><?php echo $server_performance['boot']; ?></td>
									</tr>
									<tr>
										<th scope="row">Server OS</th>
										<td><?php echo $server_performance['OS']; ?></td>
									</tr>
									<tr>
										<th scope="row">Server RAM Usage</th>
										<?php if ($server_performance['RAM']['used_pct'] > 80) { $desc = "bg-danger"; } else if ($server_performance['RAM']['used_pct'] > 40 && $server_performance['RAM']['used_pct'] < 80) { $desc = "bg-warning"; } else { $desc = "bg-primary"; } ?>
										<td><div class="progress"><div class="progress-bar progress-bar-striped progress-xs <?php echo $desc; ?>" role="progressbar" style="width: <?php echo $server_performance['RAM']['used_pct']; ?>%" aria-valuenow="<?php echo $server_performance['RAM']['used_pct']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server_performance['RAM']['used_pct']; ?>"></div></div><center><?php echo $server_performance['RAM']['used']; ?>/<?php echo $server_performance['RAM']['total']; ?> (<?php echo $server_performance['RAM']['used_pct']; ?>%)</center></td>
									</tr>
									<tr>
										<th scope="row">Server Disk Usage</th>
										<?php if ($server_performance['disk']['used_pct'] > 80) { $desc = "bg-danger"; } else if ($server_performance['disk']['used_pct'] > 40 && $server_performance['disk']['used_pct'] < 80) { $desc = "bg-warning"; } else { $desc = "bg-primary"; } ?>
										<td><div class="progress"><div class="progress-bar progress-bar-striped progress-xs <?php echo $desc; ?>" role="progressbar" style="width: <?php echo $server_performance['disk']['used_pct']; ?>%" aria-valuenow="<?php echo $server_performance['disk']['used_pct']; ?>" aria-valuemin="0" aria-valuemax="<?php echo $server_performance['disk']['used_pct']; ?>"></div></div><center><?php echo $server_performance['disk']['used']; ?>/<?php echo $server_performance['disk']['total']; ?> (<?php echo $server_performance['disk']['used_pct']; ?>%)</center></td>
									</tr>
									<tr>
										<th scope="row">Server Load Avg</th>
										<td><?php echo $server_performance['loadavg']; ?></td>
									</tr>
									<tr>
										<th scope="row">Server Processes</th>
										<td><?php echo $server_performance['proc']; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-5">
					<div class="card mb-3">
						<div class="card-header">
							<h3><i class="fa fa-line-chart"></i> Registrations</h3>
							Registration trend, by day, last 14 days.
						</div>
						<div class="card-body">
							<canvas id="registrationChart"></canvas>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-3">
					<div class="card mb3">
						<div class="card-header">
							<h3><i class="fa fa-user-o"></i> Admins Online</h3>
							List admins online
						</div>
						<div class="card-body">
							<table class="table table-responsive-xl table-hover">
								<thead>
									<tr>
										<th scope="col">Name</th>
										<th scope="col">Last Action</th>
										<th scope="col">Time</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($active_admins as $k=>$v) { ?>
										<tr>
											<th scope="row"><?php echo $v['username']; ?></th>
											<td><?php echo $v['lastmodule']; ?></td>
											<td><?php echo $v['lastactive']; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card mb3">
						<div class="card-header">
							<h3><i class="fa fa-envelope-o"></i> Admin Messages</h3>
						</div>
						<div class="card-body">
							<div class="widget-messages nicescroll" style="height: 400px;">
								<?php if ($admin_news != 0) { ?>
									<?php foreach($admin_news as $k) { ?>
										<?php if ($k['active'] == 1) { ?>
											<div class="message-item">
												<?php if ($k['pinned'] == 1) { echo "<i class='fa fa-thumb-tack'></i>"; } ?>
												<p class="message-item-user"><?php echo $k['username']; ?></p>
												<p class="message-item-msg"><?php echo $k['content']; ?></p>
												<p class="message-item-date"><?php echo $k['date']; ?></p>
											</div>
										<?php } ?>
									<?php } ?>
								<?php } else { ?>
									<p>No news to display!</p>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>