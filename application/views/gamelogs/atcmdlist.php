<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">@command log list</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('gamelogs/atcmd_search'); ?>" class="breadcrumb-item">Game Logs</a>
							<li class="breadcrumb-item active">@command results</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="atcmdResults">
						<thead>
							<tr>
								<th>Datetime</th>
								<th>Account ID</th>
								<th>Character ID</th>
								<th>Character Name</th>
								<th>Map</th>
								<th>Command</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($atcmd_log as $logItem) { ?>
								<tr>
									<td><?php echo $logItem['atcommand_date']; ?></td>
									<td><a href="<?php echo base_url('account/details/'.$logItem['account_id'].''); ?>"><?php echo $logItem['account_id']; ?></td>
									<td><a href="<?php echo base_url('character/details/'.$logItem['char_id'].''); ?>"><?php echo $logItem['char_id']; ?></td>
									<td><?php echo $logItem['char_name']; ?></td>
									<td><?php echo $logItem['map']; ?></td>
									<td><?php echo $logItem['command'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>