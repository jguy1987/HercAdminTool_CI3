<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Server Maintenance</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Server</li>
							<li class="breadcrumb-item active">Maintenance</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3>Server Status</h3>
							</div>
							<div class="card-body">
								<div class="small"><i>(Use the buttons to toggle the state of that server)</i></div>
								<?php foreach ($online_status as $k=>$v) { ?>
									<?php if ($v == false) { ?> 
										<?php $buttonStatus = "danger"; ?>
									<?php } else { ?>
										<?php $buttonStatus = "success"; ?>
									<?php } ?>
									<a href="<?php echo base_url('server/maintenance/toggle/'.$k.''); ?>"><button class="btn btn-<?php echo $buttonStatus; ?>"><?php echo $k; ?></button></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<h3>Server Maintenance</h3>
							</div>
							<div class="card-body">
								<a href="<?php echo base_url('server/maintenance/start'); ?>"><button type="button" class="btn btn-success <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Start Server</button></a>
								<a href="<?php echo base_url('server/maintenance/stop'); ?>"><button type="button" class="btn btn-danger <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Stop Server</button></a>
								<a href="<?php echo base_url('server/maintenance/restart'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Restart Server</button></a><br /><br />
								<a href="<?php echo base_url('server/maintenance/updatefiles'); ?>"><button type="button" class="btn btn-info <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Update Files</button></a><br /><br />
								<a href="<?php echo base_url('server/maintenance/reloadscript'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload Scripts</button></a>
								<a href="<?php echo base_url('server/maintenance/reloadbattleconf'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload Battle Conf</button></a>
								<a href="<?php echo base_url('server/maintenance/reloadatcommand'); ?>"><button type="button" class="btn btn-warning <?php if ($check_perm['servermaint'] == 0) { echo "disabled"; } ?>">Reload @command</button></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card">
						<div class="card-header">
							<h3>Server Statistics</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
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
				<div class="col-lg-6">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h3><a href="<?php echo base_url('server/console/login'); ?>">Login Server console (Last 15 lines)</a></h3>
							</div>
							<div class="card-body">
								<?php echo nl2br($server_log['login']); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h3><a href="<?php echo base_url('server/console/char'); ?>">Char Server console (Last 15 lines)</a></h3>
							</div>
							<div class="card-body">
								<?php echo nl2br($server_log['char']); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h3><a href="<?php echo base_url('server/console/map'); ?>">Map Server console (Last 15 lines)</a></h3>
							</div>
							<div class="card-body">
								<?php echo nl2br($server_log['map']); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>