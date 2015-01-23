!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Access Denied!</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<div class="col-lg-12">
			<?php switch( $referpage ) { 
				case "noperm": 
					echo "<p>Sorry, your group does not give you adequate permission to use this function. Return to the <a href='/'>dashboard</a>.";
					break;
				case "groupdeny": 
					echo "<p>You may not edit a user who's group is equal to or higher than your own! Return to the <a href='/'>dashboard</a>.";
					 break;
			} ?>
		</div>
	<!-- /.container-fluid -->
	</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->