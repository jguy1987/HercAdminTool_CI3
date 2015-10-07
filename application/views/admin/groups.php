<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Admin Groups</h1>
			 </div>
		</div>
	</div>
	<p>Listing all groups for Admin Tool.</p>
	<div class="panel-body">
		<div class="table-responsive">
			<a href="/admin/addgroup/"><button type="button" class="btn btn-primary">Add New Group</button></a><br /><br />
			<table class="table table-striped table-bordered table-hover" id="dataTables-listsm">
				<thead>
					<tr>
						<th style="width: 38px;">GroupID</th>
						<th style="width: 100px;">Group Name</th>
						<th style="width: 150px;">Users Assigned</th>
						<th style="width: 100px;">Options</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($group_results as $group_entry): ?>
					<tr class="odd gradeX">
						<td><?php echo $group_entry['id']; ?></td>
						<td><?php echo $group_entry['name']; ?></td>
						<td>
						<?php foreach ($name_results[$group_entry['id']] as $name): ?>
							<?php echo "<a href='/admin/edituser/".$name['id']."'>".$name['username']."</a>,&nbsp;"; ?>
						<?php endforeach; ?></td>
						<td><a href="/admin/editgroup/<?php echo $group_entry['id']; ?>"><button type="button" class="btn btn-success">Edit</button></a>&nbsp;<a href="/admin/delgroup/<?php echo $group_entry['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>&nbsp;<a href="/sendemail/admingroup/<?php echo $group_entry['id']; ?>"><button type="button" class="btn btn-info">Send Email</button></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<i>Please note it is not possible to delete a group which has assigned users. Please move those users into another group before trying to delete a group.</i>
		</div>
	</div>
</div>