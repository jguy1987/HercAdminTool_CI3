<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Characters</h1>
			</div>
		</div>
	</div>
	<p>Listing in-game characters. Click on the edit button or the character ID to edit that account.</p>
	<div class="panel-body">
		<a href="/character/search" class="btn btn-info">Modify Search</a>
		<?php echo validation_errors(); ?>
		<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
			<thead>
				<tr>
					<th style="width: 75px;">CharID</th>
					<th style="width: 100px;">Name</th>
					<th style="width: 30px;">Gender</th>
					<th style="width: 100px;">Class</th>
					<th style="width: 75px;">Base/Job Level</th>
					<th style="width: 100px;">Guild</th>
					<th style="width: 100px;">Party</th>
					<th style="width: 50px;">Online?</th>
					<th style="width: 100px;">Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($char_list as $char_data): ?>
					<tr class="odd gradeX">
						<td><a href="/character/details/<?php echo $char_data['char_id']; ?>"><?php echo $char_data['char_id']; ?></a></td>
						<td><?php echo $char_data['name']; ?></td>
						<td><?php echo $char_data['sex']; ?></td>
						<td><?php echo $class_list[$char_data['class']]; ?></td>
						<td><?php echo $char_data['base_level']; ?>/<?php echo $char_data['job_level']; ?></td>
						<td><a href="/guild/details/<?php echo $char_data['guild_id']; ?>"><?php echo $char_data['guild_name']; ?></a></td>
						<td><a href="/party/details/<?php echo $char_data['party_id']; ?>"><?php echo $char_data['party_name']; ?></a></td>
						<td><?php if ($char_data['online'] == 1) { echo "Yes"; } elseif ($char_data['online'] == 0) { echo "No"; }?></td>
						<td><a href="/character/resetpos/<?php echo $char_data['char_id']; ?>" class="btn btn-sm btn-success <?php if ($char_data['delete_date'] > 0) { echo "disabled"; } ?>">Reset Position</a>&nbsp;<?php if ($char_data['delete_date'] > 0) { ?><button class="btn btn-danger btn-xs disabled">DELETION PENDING</button><?php } ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>