<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Changes processed</h1>
			</div>
		</div>
		<div class="col-lg-12">
			<?php switch( $maint_result ) {
				case "didnotstart": 
					echo "The servers did not start. You can find the full logs below to troubleshoot.";
					break;
				case "startsuccess":
					echo "Server started successfully.";
					break;
				case "stop":
					echo "Server stopped.";
					break;
				case "restartsuccess":
					echo "Server was restarted.";
					break;
				default:
					echo "An unknown error occurred. Report to developer!";
					break;
			} ?>
		</div>
	</div>
</div>