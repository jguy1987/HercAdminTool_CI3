!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Access Denied!</h1>
			</div>
		</div>
		<div class="col-lg-12">
			<?php switch( $referpage ) { 
				case "noperm": 
					echo "<p>Sorry, your group does not give you adequate permission to use this function. Return to the <a href='/'>dashboard</a>.";
					break;
				case "groupdeny": 
					echo "<p>You may not edit a user who's group is equal to or higher than your own! Return to the <a href='/'>dashboard</a>.";
					break;
				case "groupfull":
					echo "You may not delete a group which has members in it. Remove the members from the group and then you may delete it. Return to <a href='/admin/groups'>group management page</a>.";
					break;
				case "group99":
					echo "You may not delete the admin group. Return to <a href='/admin/groups'>group management page</a>.";
					break;
				default:
					echo "<p>General failure. Return to the <a href='/'>dashboard</a>.";
					break;
			} ?>
		</div>
	</div>
</div>