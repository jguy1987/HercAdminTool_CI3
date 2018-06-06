<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Zeny Log List</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('gamelogs/zeny_search'); ?>" class="breadcrumb-item">Game Logs</a>
							<li class="breadcrumb-item active">zeny log results</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover" id="zenyResults">
						<thead>
							<tr>
								<th>Datetime</th>
								<th>Source ID</th>
								<th>Destination ID</th>
								<th>Type</th>
								<th>Amount</th>
								<th>Map</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($zenylogResults as $logItem) { ?>
								<tr>
									<td><?php echo $logItem['time']; ?></td>
									<td><a href="<?php echo base_url('character/details/'.$logItem['src_id'].''); ?>"><?php echo $logItem['src_id']; ?></td>
									<td><a href="<?php echo base_url('character/details/'.$logItem['char_id'].''); ?>"><?php echo $logItem['char_id']; ?></td>
									<td><?php echo $type_list[$logItem['type']]; ?></td>
									<td><?php echo $logItem['amount']; ?></td>
									<td><?php echo $logItem['map'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>