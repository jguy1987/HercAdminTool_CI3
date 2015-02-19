<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Search Game Accounts</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
					<?php foreach ($search_results as $acctData): ?>
					<tr class="odd gradeX">
						<td><a href="/account/details/<?php echo $acctData['account_id']; ?>"><?php echo $acctData['account_id']; ?></td>
						<td><?php if ($acctData['group_id'] > 0) { ?><div style="color:#FF0000; "> <?php } ?><?php echo $acctData['userid']; ?><?php if ($acctData['group_id'] > 0) { ?></div><?php } ?></td>
						<td><?php echo $acctData['sex']; ?></td>
						<td><?php echo $acctData['email']; ?></td>
						<td><?php echo $acctData['createdate']; ?></td>
						<td><?php echo $acctData['lastlogin']; ?></td>
						<td><?php if ($acctData['unban_time'] != 0 || $acctData['state'] != 0) { echo "Yes"; } else { echo "No"; }?></td>
						<td>Delete</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>