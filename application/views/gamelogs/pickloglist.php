<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">pick log</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listxlg">
				<thead>
					<tr>
						<th>Datetime</th>
						<th>Character ID</th>
						<th>Type</th>
						<th>ItemID</th>
						<th>Amount</th>
						<th>Unique ID</th>
						<th>Map</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($picklogResults as $logItem) { ?>
						<tr>
							<td><?php echo $logItem['time']; ?></td>
							<td><a href="/character/details/<?php echo $logItem['char_id']; ?>"><?php echo $logItem['char_id']; ?></td>
							<td><?php echo $logItem['type']; ?></td>
							<td><?php echo $logItem['nameid']; ?></td>
							<td><?php echo $logItem['amount']; ?></td>
							<td><?php echo $logItem['unique_id']; ?></td>
							<td><?php echo $logItem['map'] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>