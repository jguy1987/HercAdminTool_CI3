<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Admin Accounts</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<p>Listing all accounts for Admin Tool.</p>
				<div class="panel-body">
					<div class="table-responsive">
						<a href="/admin/adduser/"><button type="button" class="btn btn-primary">Add New User</button></a><br /><br />
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 50px;">Account ID</th>
									<th style="width: 100px;">Username</th>
									<th style="width: 230px;">Gender</th>
									<th style="width: 100px;">Email</th>
									<th style="width: 75px;">Registered</th>
									<th style="width: 75px;">Last Login</th>
									<th style="width: 100px;">Group</th>
									<th style="width: 100px;">Banned?</th>
									<th style="width: 30px;">Login Count</th>
									<th style="width: 200px;">Last IP</th>
									<th style="width: 150px;">Birthdate</th>
									<th style="width: 100px;">Options</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($accts as $acct_data): ?>
								<tr class="odd gradeX">
									<td><?php echo $acct_data->account_id; ?></td>
									<td><?php echo $acct_data->userid; ?></td>
									<td><?php echo $acct_data->sex; ?></td>
									<td><?php echo $acct_data->email; ?></td>
									<td><?php echo $acct_data->createdate; ?></td>
									<td><?php echo $acct_data->lastlogin; ?></td>
									<td><?php echo $acct_data->group_id; ?></td>
									<td><?php echo $acct_data->state; ?></td>
									<td><?php echo $acct_data->logincount; ?></td>
									<td><?php echo $acct_data->last_ip; ?></td>
									<td><?php echo $acct_data->birthdate; ?></td>
									<td>Edit Delete</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>