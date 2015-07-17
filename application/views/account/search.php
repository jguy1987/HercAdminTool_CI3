<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Accounts</h1>
			</div>
		</div>
	</div>
	<p>Search in-game Accounts. Leave the query blank to list all.</p>
	<div class="panel-body">
		<?php echo form_open('account/resultlist'); ?>
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