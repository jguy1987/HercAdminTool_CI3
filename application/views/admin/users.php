<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Panel Users</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Admin</li>
							<li class="breadcrumb-item active">Users</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<a href="<?php echo base_url('admin/adduser'); ?>"><button type="button" class="btn btn-primary">Add New User</button></a>&nbsp;
				<a href="<?php echo base_url('admin/lockusers'); ?>"><button type="button" class="btn btn-danger">Disable All Users</button></a>&nbsp;
				<a href="<?php echo base_url('admin/unlockusers'); ?>"><button type="button" class="btn btn-success">Enable All Users</button></a>&nbsp;
				<a href="<?php echo base_url('admin/resetusers'); ?>"><button type="button" class="btn btn-warning">Reset All Passwords</button></a>
				<br /><br />
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover display dt-responsive nowrap" id="dt-default">
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
							<tr>
								<td><a href="<?php echo base_url('admin/edituser/'.$admin_entry->userid.''); ?>"><?php echo $admin_entry->userid; ?></a></td>
								<td><?php echo $admin_entry->username; ?></td>
								<td><?php echo $admin_entry->pemail; ?></td>
								<td><a href='<?php echo base_url('account/details/'.$admin_entry->gameacctid.''); ?>'><?php echo $admin_entry->gameacctid; ?></a></td>
								<td><?php echo $admin_entry->createdate; ?></td>
								<td><?php echo $admin_entry->lastactive; ?></td>
								<?php if ($admin_entry->disablelogin == 1) { ?>
									<td>Yes</td>
								<?php } else { ?>
									<td>No</td>
								<?php } ?>
								<td><?php echo $admin_entry->group_name; ?></td>
								<td><a href="<?php echo base_url('admin/deluser/'.$admin_entry->userid.''); ?>"><button type="button" class="btn btn-danger">Delete</button></a>&nbsp;<a href="<?php echo base_url('sendemail/adminuser/'.$admin_entry->userid.''); ?>"><button type="button" class="btn btn-info">Send Email</button></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>						
				</div>
			</div>
		</div>
	</div>
</div>
