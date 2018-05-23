<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Automated Broadcast System</h1>
			</div>
		</div>
	</div>
	<p>Create, delete, enable, disable or edit broadcasts below. Broadcasts can only be set for 5 minute intervals minimum and can only contain 60 characters max each line. Please note you may not have more than 128 broadcasts active at any one time. Broadcasts setup here are to the entire server at one time.</p>
	<div class="panel-body">
		<a href="<?php echo base_url('server/broadcast_add'); ?>" class="btn btn-info">Add new Broadcast</a><br /><br />
		<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
			<thead>
				<tr>
					<th style="width: 50px;">ID</th>
					<th style="width: 100px;">Username</th>
					<th style="width: 235px;">Contents</th>
					<th style="width: 125px;">Created</th>
					<th style="width: 100px;">Interval (mins)</th>
					<th style="width: 125px;">Last event</th>
					<th style="width: 75px;">Enabled</th>
					<th style="width: 140px;">Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($broadcasts as $bcast): ?>
					<tr class="odd gradeX">
					<td><a href="<?php echo base_url('server/broadcast_edit/'.$bcast['b_id'].''); ?>"><?php echo $bcast['b_id']; ?></td>
					<td><?php echo $bcast['username']; ?></td>
					<td><?php echo $bcast['contents']; ?><br /><?php echo $bcast['contents2']; ?><br /><?php echo $bcast['contents3']; ?><br /><?php echo $bcast['contents4']; ?><br /></td>
					<td><?php echo $bcast['createdate']; ?></td>
					<td><?php echo $bcast['b_interval']; ?></td>
					<td><?php echo $bcast['b_lastevent']; ?></td>
					<td><?php if ($bcast['enabled'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
					<td><a href="<?php echo base_url('server/broadcast_delete/'.$bcast['b_id'].''); ?>" class="btn btn-sm btn-danger">Delete</a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>