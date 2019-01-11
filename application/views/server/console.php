<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left"><?php echo $server; ?> console output</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Server</li>
							<li class="breadcrumb-item active">Console</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3><?php echo $server; ?> console output</h3>
						</div>
						<div class="card-body">
							<?php echo nl2br($server_log); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>