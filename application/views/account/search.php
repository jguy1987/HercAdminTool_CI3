<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Accounts</h1>
			</div>
		</div>
	</div>
	<p>In-game account search. Searches are wildcarded. Use "=" sign before any search term to search for that string exactly. Leave all fields blank to search for all.</p>
	<div class="panel-body">
		<?php echo form_open('account/resultlist'); ?>
			<center>
				<table class="table">
					<tr>
						<td>
							<label>Account ID</label>
						</td>
						<td>
							<input type="text" name="acct_id" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Account Name</label>
						</td>
						<td>
							<input type="text" name="acct_name" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Email Address</label>
						</td>
						<td>
							<input type="text" name="email" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Gender</label>
						</td>
						<td>
							<input type="radio" name="gender" id="optionsRadiosInline1" value="M" />&nbsp;Male
							&nbsp;&nbsp;&nbsp;<input type="radio" name="gender" id="optionsRadiosInline2" value="F" />&nbsp;Female
						</td>
					</tr>
					<tr>
						<td>
							<label>Is Banned?</label>
						</td>
						<td>
							<input type="checkbox" name="isBanned" value="1" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Is GM?</label>
						</td>
						<td>
							<input type="checkbox" name="isGM" value="1" />
						</td>
					</tr>
				</table>
				<div class="row">
					<button type="submit" class="btn btn-success">Submit search</button>
				</div>
			</center>
				
		<?php echo form_close(); ?>