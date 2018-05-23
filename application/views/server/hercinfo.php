<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo $serverName; ?> Information</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Server Status <div class="small">(Use the buttons to toggle the state of that server)</div>
					</div>
					<div class="panel-body">
						<?php if ($online_status['login'] == false) { ?> 
							<a href="<?php echo base_url('maintenance/toggle/login'); ?>"><button class="btn btn-danger">Login</button></a>
						<?php } else { ?>
							<a href="<?php echo base_url('maintenance/toggle/login'); ?>"><button class="btn btn-success">Login</button></a>
						<?php } ?>
						<?php if ($online_status['char'] == false) { ?>
							<a href="<?php echo base_url('maintenance/toggle/char'); ?>"><button class="btn btn-danger">Character</button></a>
						<?php } else { ?>
							<a href="<?php echo base_url('maintenance/toggle/char'); ?>"><button class="btn btn-success">Character</button></a>
						<?php } ?>
						<?php if ($online_status['map'] == false) { ?>
							<a href="<?php echo base_url('maintenance/toggle/map'); ?>"><button class="btn btn-danger">Map</button></a>
						<?php } else { ?>
							<a href="<?php echo base_url('maintenance/toggle/map'); ?>"><button class="btn btn-success">Map</button></a>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Server Maintenance
					</div>
					<div class="panel-body">
						<a href="<?php echo base_url('maintenance/start'); ?>"><button type="button" class="btn btn-success <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Start Server</button></a>
						<a href="<?php echo base_url('maintenance/stop'); ?>"><button type="button" class="btn btn-danger <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Stop Server</button></a>
						<a href="<?php echo base_url('maintenance/restart'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Restart Server</button></a><br /><br />
						<a href="<?php echo base_url('maintenance/updatefiles'); ?>"><button type="button" class="btn btn-info <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Update Files</button></a><br /><br />
						<a href="<?php echo base_url('maintenance/reloadscript'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload Scripts</button></a>
						<a href="<?php echo base_url('maintenance/reloadbattleconf'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload Battle Conf</button></a>
						<a href="<?php echo base_url('maintenance/reloadatcommand'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload @command</button></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Hercules Stats
					</div>
					<div class="panel-body">
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
			</div>
		</div>
		<div class="col-lg-4">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Last 15 lines Login Server <a href="<?php echo base_url('console/login'); ?>">console</a>
					</div>
					<div class="panel-body">
						<?php echo nl2br($server_log['login']); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Last 15 lines Char Server <a href="<?php echo base_url('console/char'); ?>">console</a>
					</div>
					<div class="panel-body">
						<?php echo nl2br($server_log['char']); ?>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"> 
						<i class="fa fa-bar-chart-o fa-fw"></i> Last 15 lines Map Server <a href="<?php echo base_url('console/map'); ?>">console</a>
					</div>
					<div class="panel-body">
						<?php echo nl2br($server_log['map']); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>