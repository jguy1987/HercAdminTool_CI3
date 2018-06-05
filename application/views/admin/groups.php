<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Panel Groups</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Admin</li>
							<li class="breadcrumb-item active">Groups</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="table-responsive">
					<a href="<?php echo base_url('admin/addgroup'); ?>"><button type="button" class="btn btn-primary">Add New Group</button></a><br /><br />
					<table class="table table-striped table-bordered table-hover dt-responsive" id="groupsList">
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
								<td><a href="<?php echo base_url('admin/editgroup/'.$group_entry['id'].''); ?>"><button type="button" class="btn btn-success">Edit</button></a>&nbsp;<a href="/admin/delgroup/<?php echo $group_entry['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>&nbsp;<a href="<?php echo base_url('sendemail/admingroup/'.$group_entry['id'].''); ?>"><button type="button" class="btn btn-info">Send Email</button></a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<i>Please note it is not possible to delete a group which has assigned users. Please move those users into another group before trying to delete a group.</i>
				</div>
			</div>
		</div>
	</div>
</div>