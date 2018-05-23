<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">zeny log</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listxlg">
				<thead>
					<tr>
						<th>Datetime</th>
						<th>Source ID</th>
						<th>Destination ID</th>
						<th>Type</th>
						<th>Amount</th>
						<th>Map</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($zenylogResults as $logItem) { ?>
						<tr>
							<td><?php echo $logItem['time']; ?></td>
							<td><a href="<?php echo base_url('character/details/'.$logItem['src_id'].''); ?>"><?php echo $logItem['src_id']; ?></td>
							<td><a href="<?php echo base_url('character/details/'.$logItem['char_id'].''); ?>"><?php echo $logItem['char_id']; ?></td>
							<td><?php echo $logItem['type']; ?></td>
							<td><?php echo $logItem['amount']; ?></td>
							<td><?php echo $logItem['map'] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>