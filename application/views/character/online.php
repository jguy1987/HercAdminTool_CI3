<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Who's Online</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('character/search'); ?>" class="breadcrumb-item">Character</a>
							<li class="breadcrumb-item active">Who's Online</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="onlineList" class="table table-striped table-bordered table-hover display dt-responsive nowrap">
							<thead>
								<tr>
									<th>Account ID</th>
									<th>Char ID</th>
									<th>Char Name</th>
									<th>Class</th>
									<th>Base Level</th>
									<th>Job Level</th>
									<th>Zeny</th>
									<th>Guild</th>
									<th>Last location</th>
									<th>Options</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($online_list as $oChar): ?>
									<tr class="odd gradeX">
										<td><a href="<?php echo base_url('account/details/'.$oChar['account_id'].''); ?>"><?php echo $oChar['account_id']; ?></td>
										<td><a href="<?php echo base_url('character/details/'.$oChar['char_id'].''); ?>"><?php echo $oChar['char_id']; ?></td>
										<td><?php echo $oChar['name']; ?></td>
										<td><?php echo $class_list[$oChar['class']]; ?></td>
										<td><?php echo $oChar['base_level']; ?></td>
										<td><?php echo $oChar['job_level']; ?></td>
										<td><?php echo $oChar['zeny']; ?></td>
										<td><?php echo $oChar['guild_name']; ?></td>
										<td><?php echo $oChar['last_map']."&nbsp;".$oChar['last_x'].",&nbsp;".$oChar['last_y']; ?></td>
										<td><a href="<?php echo base_url('character/kick/'.$oChar['char_id'].''); ?>"><button type="button" class="btn btn-danger">Kick</button></a>&nbsp;Ban&nbsp;</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	