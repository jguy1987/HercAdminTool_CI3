<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Dashboard</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-lg-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> Account Registrations Past 7 days
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div id="acct-regs" style="height: 234px;"></div>
				</div>
				<!-- /.panel-body -->
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
		<!-- /.row -->
		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					Server Statistics
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="dataTables-example">
						<thead>
							<?php foreach($server_stats as $desc => $value): ?>
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
<!-- /#page-wrapper -->
</div>