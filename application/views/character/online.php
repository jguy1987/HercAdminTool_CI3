<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Who's Online</h1>
			</div>
		</div>
		<p>Characters Online</p>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
						<tr>
							<th style="width: 50px;">Account ID</th>
							<th style="width: 50px;">Char ID</th>
							<th style="width: 100px;">Char Name</th>
							<th style="width: 100px;">Class</th>
							<th style="width: 60px;">Base Level</th>
							<th style="width: 60px;">Job Level</th>
							<th style="width: 75px;">Zeny</th>
							<th style="width: 100px;">Guild</th>
							<th style="width: 125px;">Last location</th>
							<th style="width: 100px;">Options</th>
						<tr>
					</thead>
					<tbody>
						<?php foreach ($online_list as $oChar): ?>
							<tr class="odd gradeX">
								<td><a href="/account/details/<?php echo $oChar['account_id']; ?>"><?php echo $oChar['account_id']; ?></td>
								<td><a href="/character/details/<?php echo $oChar['char_id']; ?>"><?php echo $oChar['char_id']; ?></td>
								<td><?php echo $oChar['name']; ?></td>
								<td><?php echo $class_list[$oChar['class']]; ?></td>
								<td><?php echo $oChar['base_level']; ?></td>
								<td><?php echo $oChar['job_level']; ?></td>
								<td><?php echo $oChar['zeny']; ?></td>
								<td><?php echo $oChar['guild_name']; ?></td>
								<td><?php echo $oChar['last_map']."&nbsp;".$oChar['last_x'].",&nbsp;".$oChar['last_y']; ?></td>
								<td>Kick&nbsp;Ban&nbsp;</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>