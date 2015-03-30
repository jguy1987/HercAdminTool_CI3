<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Server Performance</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Server Performance Data
				</div>
				<div class="panel-body">
					<label>System Uptime</label><br />
					<?php echo $server_stats['UpTime']; ?>
					<br />
					<label>Load Averages</label><br />
					<?php echo $server_stats['Load']['now']; ?>,
					<?php echo $server_stats['Load']['5min']; ?>,
					<?php echo $server_stats['Load']['15min']; ?>
					<br />
					<label>Memory Usage</label><br />
					<div class="progress">
						<?php
							if ($server_stats['RAM']['used_pct'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
							elseif ($server_stats['RAM']['used_pct'] > 49 && $server_stats['RAM']['used_pct'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
							elseif ($server_stats['RAM']['used_pct'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
						?>
						role="progressbar" aria-valuenow="<?php echo $server_stats['RAM']['used_pct']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $server_stats['RAM']['used_pct']; ?>%">
						</div>
					</div><center><?php echo $server_stats['RAM']['used']; ?> / <?php echo $server_stats['RAM']['total']; ?> (<?php echo $server_stats['RAM']['used_pct']; ?>%)</center>
					<label>Swap Usage</label><br />
					<div class="progress">
						<?php
							if ($server_stats['RAM']['swapUsed_pct'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
							elseif ($server_stats['RAM']['swapUsed_pct'] > 49 && $server_stats['RAM']['swapUsed_pct'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
							elseif ($server_stats['RAM']['swapUsed_pct'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
						?>
						role="progressbar" aria-valuenow="<?php echo $server_stats['RAM']['swapUsed_pct']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $server_stats['RAM']['swapUsed_pct']; ?>%">
						</div>
					</div><center><?php echo $server_stats['RAM']['swapUsed']; ?> / <?php echo $server_stats['RAM']['swapTotal']; ?> (<?php echo $server_stats['RAM']['swapUsed_pct']; ?>%)</center>
					<label>Running Processes Info</label><br />
					<?php echo $server_stats['processStats']['totals']['running']; ?> Running,&nbsp;
					<?php echo $server_stats['processStats']['totals']['zombie']; ?> Zombie,&nbsp;
					<?php echo $server_stats['processStats']['totals']['sleeping']; ?> Sleeping,&nbsp;
					<?php echo $server_stats['processStats']['proc_total']; ?> Total<br />
					Threads: <?php echo $server_stats['processStats']['threads']; ?>
					<br />
					<label>Hercules Server Maintenance/Status</label><br />
					<small>(Note: Click on the server status icon to see last console data from server)</small><br />
					<?php if ($online_status == 1 || $online_status == 3 || $online_status == 5 || $online_status == 7) { ?> 
						<button class="btn btn-danger btn-circle" data-toggle="collapse" data-parent="#accordion" href="#loginDetails">L</button>
					<?php } else { ?>
						<button class="btn btn-success btn-circle" data-toggle="collapse" data-parent="#accordion" href="#loginDetails">L</button>
					<?php } ?>
					<?php if ($online_status == 2 || $online_status == 3 || $online_status == 6 || $online_status == 7) { ?>
						<button class="btn btn-danger btn-circle" data-toggle="collapse" data-parent="#accordion" href="#charDetails">C</button>
					<?php } else { ?>
						<button class="btn btn-success btn-circle" data-toggle="collapse" data-parent="#accordion" href="#charDetails">C</button>
					<?php } ?>
					<?php if ($online_status == 4 || $online_status == 5 || $online_status == 6 || $online_status == 7) { ?>
						<button class="btn btn-danger btn-circle" data-toggle="collapse" data-parent="#accordion" href="#mapDetails">M</button>
					<?php } else { ?>
						<button class="btn btn-success btn-circle" data-toggle="collapse" data-parent="#accordion" href="#mapDetails">M</button>
					<?php } ?>
					<a href="/server/maintenance/start"><button type="button" class="btn btn-success <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Start Server</button></a>
					<a href="/server/maintenance/stop"><button type="button" class="btn btn-danger <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Stop Server</button></a>
					<a href="/server/maintenance/restart"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Restart Server</button></a>
					<div id="loginDetails" class="panel-collapse collapse">
						<div class="panel-body">
							<label>Login Server Console:</label>
							<?php echo $server_log['login']; ?>
						</div>
					</div>
					<div id="charDetails" class="panel-collapse collapse">
						<div class="panel-body">
							<label>Char Server Console</label>
							<?php echo $server_log['char']; ?>
						</div>
					</div>
					<div id="mapDetails" class="panel-collapse collapse">
						<div class="panel-body">
							<label>Map Server Console</label>
							<?php echo $server_log['map']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Hard Drive Usage
				</div>
				<div class="panel-body">
					<?php foreach ($server_stats['Mounts'] as $mountid=>$parm) { ?>
						<label>Mount Point: <?php echo $parm['mount']; ?></label><br />
						<div class="progress">
						<?php
							if ($parm['used_percent'] <= 49) { echo "<div class='progress-bar progress-bar-success'"; }
							elseif ($parm['used_percent'] > 49 && $parm['used_percent'] <= 79) { echo "<div class='progress-bar progress-bar-warning'"; }
							elseif ($parm['used_percent'] >= 79) { echo "<div class='progress-bar progress-bar-danger'"; }
						?>
						role="progressbar" aria-valuenow="<?php echo $parm['used_percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $parm['used_percent']; ?>%">
						</div>
					</div><center><?php echo $parm['used']; ?> / <?php echo $parm['size']; ?> (<?php echo $parm['used_percent']; ?>%)</center>
					<?php } ?>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Network Bandwidth
				</div>
				<div class="panel-body">
					<?php foreach ($server_stats['Network Devices'] as $netid=>$netparm) { ?>
						<label>Device: <?php echo $netid; ?></label><br />
						<span><strong>Received:</strong> <?php echo $netparm['received_f']; ?>&nbsp;&nbsp;&nbsp;<strong>Sent:</strong> <?php echo $netparm['sent_f']; ?></span><br /><br />
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
		</div>
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> MySQL Performance Data
				</div>
				<div class="panel-body">
					<div class="table-responsive">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>