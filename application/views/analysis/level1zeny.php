<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Level 1 Zeny List</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<center>
		<p>This is a list of all characters on the server that are level 1 that have 1 million zeny or more.</p>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
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
</div>