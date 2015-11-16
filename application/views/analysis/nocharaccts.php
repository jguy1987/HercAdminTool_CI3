<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Accounts with no characters</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<center>
		<p>This is a list of all accounts that have not created a character.</p>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
				<thead>
					<th>Account ID</th>
					<th>Account Name</th>
					<th>Create Date</th>
					<th>Last Login Date</th>
					<th>Banned?</th>
				</thead>
				<tbody>
					<?php foreach($accountresult as $accountEntry): ?>
						<tr>
							<td><?php echo $accountEntry['account_id']; ?></td>
							<td><?php echo $accountEntry['userid']; ?></td>
							<td><?php echo $accountEntry['createdate']; ?></td>
							<td><?php echo $accountEntry['lastlogin']; ?></td>
							<td></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>