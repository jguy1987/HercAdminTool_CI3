<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@command log</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#searchCollapse">Search @cmd logs</button>
		<div id="searchCollapse" class="panel-collapse collapse">
			<?php echo form_open('gamelogs/atcmdsearch', array('class' => 'form-inline')); ?>
				<div class="row">
					<div class="col-md-3">
						<label>Character Name</label>
						<input type="text" name="char_name" class="form-control" />
					</div>
					<div class="col-md-3">
						<label>@ Command</label>
						<input type="text" name="atcmd" class="form-control" />
					</div>
					<div class="col-md-6">
						<label>Date:</label>
						<input type="text" class="form-control form_datetime" value="" name="date_start" />
						<label>&nbsp;to&nbsp;</label>
						<input type="text" class="form-control form_datetime" value="" name="date_end" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Map</label>
						<input type="text" name="map" class="form-control" />
					</div>
				</div>
				<div class="row">
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
				</div>
				<br />
			<?php echo form_close(); ?>
		</div>
		<?php echo validation_errors(); ?>
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