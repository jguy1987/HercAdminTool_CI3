<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Console Output for <?php echo $server; ?> Server</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Server Logs : <?php echo $server; ?>
				</div>
				<div class="panel-body">
					<?php echo nl2br($server_log); ?>
				</div>
			</div>
		</div>
	</div>
</div>