<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Account Statistics</h1>
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
					<?php echo $server_stats['sys_uptime']; ?>
					<br />
					<label>Load Averages</label><br />
					<?php echo $server_stats['cpu_avg']; ?>
					<br />
					<label>Memory Usage</label><br />
				</div>
			</div>
		</div>
	</div>
</div>