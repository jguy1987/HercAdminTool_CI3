<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Server Maintenance Result</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Server</li>
							<li class="breadcrumb-item active">Maintenance</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="col-lg-12">
				<?php switch( $maintresult ) {
					case "didnotstart": 
						echo "The servers did not start. You can find the full logs below to troubleshoot. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "startsuccess":
						echo "Servers started successfully. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "stop":
						echo "Server stopped. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "stopfail":
						echo "One or more servers did not stop. Please check the logs and <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "restartsuccess":
						echo "Server was restarted. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "toggleservermissing":
						echo "The server to toggle was missing from your query. Please <a href='".base_url('server/hercules')."'>go back</a> and try again.";
						break;
					case "toggleserverfailed":
						echo "An error occurred while restarting the server. Please <a href='".base_url('server/hercules')."'>go back</a>, review the logs and try again.";
						break;
					case "toggleserverstopsuccess":
						echo "The server was stopped successfully. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "toggleserverstartsuccess":
						echo "The server was started successfully. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "screenwipe":
						echo "Screens wiped! Please <a href='".base_url('server/hercules')."'>go back</a> and try again.";
						break;
					case "cmdsent":
						echo $cmd_used." sent. Results reflected in logs. <a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					case "updatefiles":
						if ($update_result == 1) {
							echo "The update operation completed successfully.";
						}
						if ($update_result == 2) {
							echo "You have an error in your hat.php, under update method. Either the update via HAT is disabled, or you have an invalid entry. No update was able to be done.";
						}
						echo "<a href='".base_url('server/hercules')."'>Return to server maintenance page</a>";
						break;
					default:
						echo "An unknown error occurred. Report to developer!";
						break;
				} ?>
			</div>
		</div>
	</div>
</div>