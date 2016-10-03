<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Server Performance Data
				</div>
				<div class="panel-body">
					<?php
					if ($server_perm == True) {
						if ($server_performance == 1) {
							echo "<label>The proper python module(s) do not exist on your Hercules server!</label>";
						}
						else if ($server_performance == 2) {
							echo "<label>Error. The data failed to load.</label>";
						}
						else { ?>
							<label>System Hostname</label>&nbsp;
							<?php echo $server_performance['name']; ?>
							<br />
							<label>System OS</label>&nbsp;
							<?php echo $server_performance['OS']; ?>
							</br >
							<label>System Boot</label>&nbsp;
							<?php echo $server_performance['boot']; ?>
							<br />
							<label>Load Averages</label>&nbsp;
							<?php echo $server_performance['loadavg']; ?>
							<br />
							<label>Memory Usage</label><br />
							<div class="progress">
								<?php
									if ($server_performance['RAM']['used_pct'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
									elseif ($server_performance['RAM']['used_pct'] > 49 && $server_performance['RAM']['used_pct'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
									elseif ($server_performance['RAM']['used_pct'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
								?>
								role="progressbar" aria-valuenow="<?php echo $server_performance['RAM']['used_pct']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $server_performance['RAM']['used_pct']; ?>%">
								</div>
							</div><center><?php echo $server_performance['RAM']['used']; ?> / <?php echo $server_performance['RAM']['total']; ?> (<?php echo $server_performance['RAM']['used_pct']; ?>%)</center>
							<label>Swap Usage</label><br />
							<div class="progress">
								<?php
									if ($server_performance['RAM']['swapUsed_pct'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
									elseif ($server_performance['RAM']['swapUsed_pct'] > 49 && $server_performance['RAM']['swapUsed_pct'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
									elseif ($server_performance['RAM']['swapUsed_pct'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
								?>
								role="progressbar" aria-valuenow="<?php echo $server_performance['RAM']['swapUsed_pct']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $server_performance['RAM']['swapUsed_pct']; ?>%">
								</div>
							</div><center><?php echo $server_performance['RAM']['swapUsed']; ?> / <?php echo $server_performance['RAM']['swapTotal']; ?> (<?php echo $server_performance['RAM']['swapUsed_pct']; ?>%)</center>
							<label>Running Processes</label>&nbsp;
							<?php echo $server_performance['proc']; ?><br />
							<br /><br />
							<label>Disk Usage on Hercules Partition</label>
								<div class="progress">
								<?php
									if ($server_performance['disk']['used_percent'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
									elseif ($server_performance['disk']['used_percent'] > 49 && $server_performance['disk']['used_percent'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
									elseif ($server_performance['disk']['used_percent'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
								?>
								role="progressbar" aria-valuenow="<?php echo $server_performance['disk']['used_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $server_performance['disk']['used_percent']; ?>%">
								</div>
							</div><center><?php echo $server_performance['disk']['used']; ?> / <?php echo $server_performance['disk']['total']; ?> (<?php echo $server_performance['disk']['used_percent']; ?>%)</center>
						<?php }
					}
					else {
						echo "<label>You do not have permission to view this!</label>";
					} ?>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Active Admins
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<th>User</th>
							<th>Last Module</th>
							<?php foreach($active_admins as $aAdmin): ?>
							<tr>
								<td><?php echo $aAdmin['username']; ?></td>
								<td><?php echo $aAdmin['lastmodule']; ?></td>
							</tr>
							<?php endforeach; ?>
						</thead>
					</table>
				</div>
			</div>
		</div>		
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-dashboard fa-fw"></i> Server Statistics
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<?php foreach($herc_stats as $desc => $value): ?>
							<tr>
								<td><?php echo $desc; ?></td>
								<td><?php echo $value; ?></td>
							</tr>
							<?php endforeach; ?>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Account Registrations Past 7 days
				</div>
				<div class="panel-body">
					<div id="acct-regs" style="height: 234px;"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Admins in Vacation Mode
				</div>
				<div class="panel-body">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<th>Admin</th>
							<th>Since</th>
						</thead>
						<tbody>
							<?php foreach($vacation_admins as $k=>$v): ?>
								<tr>
									<td><?php echo $v['username']; ?></td>
									<td><?php echo $v['vacationsince']; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> MySQL Performance Data
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php if ($server_perm == False) {
							echo "<label>You do not have permission to view this!</label>";
						} 
						else { ?>
							<table class="table table-striped table-bordered table-hover" id="dataTables-example">
								<thead>
									<th>Metric</th>
									<th>Value</th>
								</thead>
								<tbody>
									<?php foreach ($mysql_stats as $sqlStat=>$statValue) { ?>
										<tr>
											<td><?php echo $sqlStat; ?></td>
											<td><?php echo $statValue; ?></td>
										</td>
									<?php } ?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 <?php if ($server_perm == False) { echo "col-lg-offset-6"; } ?>">
			<div class="panel panel-default">
				<div class="panel-heading">
					Admin Announcements
				</div>
				<div class="panel-body">
					<ul class="chat">
						<?php foreach ($admin_news as $aNews): ?>
						<li class="left clearfix">
							<div class="chat-body clearfix">
								<div class="header">
									<strong class="primary-font"><?php echo $aNews['username']; ?></strong>
									<small class="pull-right text-muted">
										<i class="fa fa-clock-o fa-fw"></i> <?php echo $aNews['date']; ?>
									</small>
								</div>
								<p>
									<?php echo $aNews['content']; ?>
								</p>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>