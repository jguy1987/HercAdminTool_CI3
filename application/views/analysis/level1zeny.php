<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Level 1 Zeny Analysis</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Analysis</li>
							<li class="breadcrumb-item active">Zeny</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-9">
					This is a list of all characters on the server that are level 1 that have 1 million zeny or more.
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="level1Zeny">
							<thead>
								<th>Char ID</th>
								<th>Account ID</th>
								<th>Char Name</th>
								<th>Zeny</th>
								<th>Class</th>
								<th>Last Login</th>
							</thead>
							<tbody>
								<?php foreach($zenyResult as $zenyEntry): ?>
									<tr>
										<td><?php echo $zenyEntry['char_id']; ?></td>
										<td><?php echo $zenyEntry['account_id']; ?></td>
										<td><?php echo $zenyEntry['name']; ?></td>
										<td><?php echo $zenyEntry['zeny']; ?></td>
										<td><?php echo $class_list[$zenyEntry['class']]; ?></td>
										<td><?php echo $zenyEntry['lastlogin']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>