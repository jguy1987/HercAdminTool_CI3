<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Admin Accounts</h1>
			</div>
		</div>
	</div>
	<p>Listing all accounts for Admin Tool.</p>
	<div class="panel-body">
		<div class="table-responsive">
			<a href="/admin/adduser/"><button type="button" class="btn btn-primary">Add New User</button></a>&nbsp;
			<a href="/admin/lockusers"><button type="button" class="btn btn-danger">Disable All Users</button></a>&nbsp;
			<a href="/admin/unlockusers"><button type="button" class="btn btn-success">Enable All Users</button></a>&nbsp;
			<a href="/admin/resetusers"><button type="button" class="btn btn-warning">Reset All Passwords</button></a>
			<br /><br />
			<table class="table table-striped table-bordered table-hover" id="dataTables-listsm">
				<thead>
					<tr>
						<th style="width: 38px;">UserID</th>
						<th style="width: 125px;">Username</th>
						<th style="width: 200px;">Private Email</th>
						<th style="width: 75px;">In-game<br />Acct ID</th>
						<th style="width: 100px;">Created On</th>
						<th style="width: 125px;">Last Active</th>
						<th style="width: 25px;">Disable login?</th>
						<th style="width: 180px;">Group</th>
						<th style="width: 250px;">Options</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($admin_results as $admin_entry): ?>
					<tr class="odd gradeX">
						<td><?php echo $admin_entry->userid; ?></td>
						<td><?php echo $admin_entry->username; ?></td>
						<td><?php echo $admin_entry->pemail; ?></td>
						<td><?php echo "<a href='/account/details/".$admin_entry->gameacctid."'>".$admin_entry->gameacctid."</a>"; ?></td>
						<td><?php echo $admin_entry->createdate; ?></td>
						<td><?php echo $admin_entry->lastactive; ?></td>
						<?php if ($admin_entry->disablelogin == 1) { ?>
							<td>Yes</td>
						<?php } else { ?>
							<td>No</td>
						<?php } ?>
						<td><?php echo $admin_entry->group_name; ?></td>
						<td><a href="/admin/edituser/<?php echo $admin_entry->userid; ?>"><button type="button" class="btn btn-success">Edit</button></a>&nbsp;<a href="/admin/deluser/<?php echo $admin_entry->userid; ?>"><button type="button" class="btn btn-danger">Delete</button></a>&nbsp;<a href="/sendemail/adminuser/<?php echo $admin_entry->userid; ?>"><button type="button" class="btn btn-info">Send Email</button></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>						
		</div>
	</div>
</div>