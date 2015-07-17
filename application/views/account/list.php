<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Accounts</h1>
			</div>
		</div>
	</div>
	<p>Listing in-game accounts. Click on the edit button or the account ID to edit that account.</p>
	<div class="panel-body">
		<a href="/account/search" class="btn btn-info">Modify Search</a>
		<br />		
		<?php echo validation_errors(); ?>
		<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
			<thead>
				<tr>
					<th style="width: 50px;">Account ID</th>
					<th style="width: 100px;">Username</th>
					<th style="width: 35px;">Gender</th>
					<th style="width: 100px;">Email</th>
					<th style="width: 75px;">Registered</th>
					<th style="width: 125px;">Last Login</th>
					<th style="width: 75px;">Banned?</th>
					<th style="width: 100px;">Options</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($accts as $acct_data): ?>
				<tr class="odd gradeX">
					<td><a href="/account/details/<?php echo $acct_data['account_id']; ?>"><?php echo $acct_data['account_id']; ?></td>
					<td><?php if ($acct_data['group_id'] > 0) { ?><div style="color:#FF0000; "> <?php } ?><?php echo $acct_data['userid']; ?><?php if ($acct_data['group_id'] > 0) { ?></div><?php } ?></td>
					<td><?php echo $acct_data['sex']; ?></td>
					<td><?php echo $acct_data['email']; ?></td>
					<td><?php echo $acct_data['createdate']; ?></td>
					<td><?php echo $acct_data['lastlogin']; ?></td>
					<td><?php if ($acct_data['unban_time'] != 0 || $acct_data['state'] != 0) { echo "Yes"; } else { echo "No"; }?></td>
					<td>Delete</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>