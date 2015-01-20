!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Changes processed</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="col-lg-6">
					<?php switch( $referpage ) {
						case "useredit":
							echo "Admin user edit processed successfully. Return to the <a href='/admin/users'>user management page</a><br /><br />";
							break;
						case "groupadd":
							echo "Group Addition processed successfully. Return to the <a href='/admin/groups'>group management page</a><br /><br />";
							break;
						case "useradd":
							echo "Admin user added successfully. The user has received an email with their login details. Return to the <a href='/admin/users'>user management page</a><br /><br />";
							break;
						case "lockusers":
							echo "All admin user accounts locked from login. Return to the <a href='/admin/users'>user management page</a>";
							break;
						case "unlockusers":
							echo "All admin user accounts enabled to login. Return to the <a href='/admin/users'>user management page</a>";
							break;
						case "resetallpw":
							echo "All admin user accounts have had their passwords reset and have received emails with their new passwords. Return to the <a href='/admin/users'>user management page</a>";
							break;
						case "acctadd":
							echo "User's game account processed successfully. User has received an email with their password and pincode. Return to the <a href='/account/listaccts'>account management page</a>";
							break;
						case "acctnoteadd":
							echo "Note added successfully. Return to the <a href='/account/listaccts'>account management page</a>";
							break;
						default:
							echo "Return to the <a href='/'>dashboard</a>";
							break;
					} ?>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			</div>
		<!-- /#wrapper -->