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
		<div class="row">
			<div class="col-lg-12 col-sm-3">
				<a href="<?php echo base_url('account/search'); ?>" class="btn btn-info">Modify Search</a>
				<br /><br />	
				<?php echo validation_errors(); ?>
				<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="dataTables-acctlist">
					<thead>
						<tr>
							<th width="10px"></th>
							<th>Account ID</th>
							<th>Username</th>
							<th>Gender</th>
							<th>Email</th>
							<th>Registered</th>
							<th>Last Login</th>
							<th>Banned?</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($accts as $acct_data): ?>
						<tr class="odd gradeX">
							<td></td>
							<td><a href="<?php echo base_url('account/details/'.$acct_data['account_id'].''); ?>"><?php echo $acct_data['account_id']; ?></td>
							<td><?php if ($acct_data['group_id'] > 0) { ?><div style="color:#FF0000; "> <?php } ?><?php echo $acct_data['userid']; ?><?php if ($acct_data['group_id'] > 0) { ?></div><?php } ?></td>
							<td><?php echo $acct_data['sex']; ?></td>
							<td><?php echo $acct_data['email']; ?></td>
							<td><?php echo $acct_data['createdate']; ?></td>
							<td><?php echo $acct_data['lastlogin']; ?></td>
							<td><?php if ($acct_data['unban_time'] != 0 || $acct_data['state'] != 0) { echo "Yes"; } else { echo "No"; }?></td>
							<td><button type="button" class="btn btn-danger">Delete</button></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>