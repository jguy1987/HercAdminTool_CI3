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
		<button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#searchCollapse">Search Accounts</button>
		<div id="searchCollapse" class="panel-collapse collapse">
			<?php echo form_open('account/search'); ?>
				<div class="row">
					<div class="col-md-3">
						<label>Account ID</label>
						<input type="text" name="acct_id" />
					</div>
					<div class="col-md-3">
						<label>Account Name</label>
						<input type="text" name="acct_name" />
					</div>
					<div class="col-md-3">
						<label>Email Address</label>
						<input type="text" name="email" />
					</div>
					<div class="col-md-3">
						<label>Gender</label>
						<input type="radio" name="gender" id="optionsRadiosInline1" value="M" />Male
						<input type="radio" name="gender" id="optionsRadiosInline2" value="F" />Female
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Is Banned?</label>
						<input type="checkbox" name="isBanned" value="1" />
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
						<label>Is GM?</label>
						<input type="checkbox" name="isGM" value="1" />
					</div>
				</div>
				<div class="row">
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
				</div>
			<?php echo form_close(); ?>
		</div>
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