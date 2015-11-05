<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@command log</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
				<thead>
					<tr>
						<th>Datetime</th>
						<th>Account ID</th>
						<th>Character ID</th>
						<th>Character Name</th>
						<th>Map</th>
						<th>Command</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($atcmd_log as $logItem) { ?>
						<tr>
							<td><?php echo $logItem['atcommand_date']; ?></td>
							<td><a href="/account/details/<?php echo $logItem['account_id']; ?>"><?php echo $logItem['account_id']; ?></td>
							<td><a href="/character/details/<?php echo $logItem['char_id']; ?>"><?php echo $logItem['char_id']; ?></td>
							<td><?php echo $logItem['char_name']; ?></td>
							<td><?php echo $logItem['map']; ?></td>
							<td><?php echo $logItem['command'] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>