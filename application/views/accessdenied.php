<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Access Denied</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Error</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
			<?php switch( $referpage ) { 
				case "noperm": 
					echo "<p>Sorry, your group does not give you adequate permission to use this function. Return to the <a href='".base_url()."'>dashboard</a>.";
					break;
				case "groupdeny": 
					echo "<p>You may not edit a user who's group is equal to or higher than your own! Return to the <a href='".base_url()."'>dashboard</a>.";
					break;
				case "groupfull":
					echo "You may not delete a group which has members in it. Remove the members from the group and then you may delete it. Return to <a href='".base_url('admin/groups')."'>group management page</a>.";
					break;
				case "group99":
					echo "You may not delete the admin group. Return to <a href='".base_url('admin/groups')."'>group management page</a>.";
					break;
				case "serveronline-leaderassign":
					echo "Leader cannot be reassigned. The server is online. Return to the <a href='".base_url('guild/listguilds')."'>guild list</a>.";
					break;
				default:
					echo "<p>General failure. Return to the <a href='".base_url()."'>dashboard</a>.";
					break;
			} ?>
		</div>
	</div>
</div>