<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Viewing Account</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">User</a>
							<li class="breadcrumb-item active">Settings</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<p>Here you can change the settings for your admin panel account</p>
				
				<?php echo form_open('user/verifyedit', '', array('userid' => $user_settings->id)); ?>
				<p>Note: You must enter your current password in order to make any changes on this page. Do not enter a New Password if you do not intend to change it.</p>
				<strong><?php echo validation_errors(); ?></strong>
				<div class="row">
					<div class="col-md-3">
						<label>Current Password:</label>&nbsp;<input type="password" class="form-control" size="40px" name="currpass" /><br />
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<fieldset>
							<div class="form-group">
								<label>Private Email</label>
								<input class="form-control" size="40px" name="pemail" value="<?php echo $user_settings->pemail; ?>" />
							</div>
						</fieldset>
					</div>		
					<div class="col-lg-3">
						<fieldset>
							<div class="form-group">
								<label>Change password:</label><br />
								<label>New Password:</label>&nbsp;<input type="password" class="form-control" size="40px" name="newpass" /><br />
								<label>Confirm new Password:</label>&nbsp;<input type="password" class="form-control" size="40px" name="confirmpass" /><br />
							</div>
						</fieldset>
					</div>
					<div class="col-lg-3">
						<fieldset>
							<div class="form-group">
								<label>Activate Vacation Mode</label>
								<p>(Note: While in vacation mode you cannot use most functions of the panel. You will not be available for assignment of bugs or tickets.)</p>
								<input class="form-control" type="checkbox" value="1" <?php if ($user_settings->vacation == 1) { echo "checked"; } ?> name="vacation" />
								<?php if ($user_settings->vacation == 1) { ?>
									<label>Vacation Mode Since:</label>&nbsp;<?php echo $user_settings->vacationsince; ?>
								<?php } ?>
							</div>
						</fieldset>
					</div>
				</div>
				<input type="submit" class="btn btn-warning" value="Change Settings" />
				<br /><br />
				<div class="row">
					<strong>Group Membership</strong><br />
					<p>You are part of the <?php echo $user_settings->groupname; ?> group. You may perform the following actions:</p>
				</div>
				<div class="row">
					<div class="col-lg-3">
						<label>Account Module Permissions</label><br />
						<?php foreach($permissions['account'] as $perm=>$text): ?>
							<?php if ($perm == "acctgroupmax") { ?>
								<input type="number" name="perm[<?php echo $perm; ?>]" value="<?php echo $grpInfo->acctgroupmax; ?>" disabled />&nbsp;<?php echo $text; ?><br />
							<?php } else { ?>
								<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
								<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
							<?php } ?>
						<?php endforeach; ?>
					</div>
					<div class="col-lg-3">
						<label>Character Module Permissions</label><br />
						<?php foreach($permissions['character'] as $perm=>$text): ?>
							<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
					<div class="col-lg-3">
						<label>Admin Panel Module Permissions</label><br />
						<?php foreach($permissions['admin'] as $perm=>$text): ?>
							<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
					<div class="col-lg-3">
						<label>Bugtracker Module Permissions</label><br />
						<?php foreach($permissions['bugtracker'] as $perm=>$text): ?>
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-lg-3">
						<label>Ticket Module Permissions</label><br />
						<?php foreach($permissions['ticket'] as $perm=>$text): ?>
							<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
					<div class="col-lg-3">
						<label>Server Setting Module Permissions</label><br />
						<?php foreach($permissions['server'] as $perm=>$text): ?>
							<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
					<div class="col-lg-3">
						<label>Log Module Permissions</label><br />
						<?php foreach($permissions['log'] as $perm=>$text): ?>
							<input type="hidden" name="perm[<?php echo $perm; ?>]" value="0" />
							<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" <?php if ($grpInfo->{$perm} == 1) { echo "checked"; } ?> disabled />&nbsp;<?php echo $text; ?><br />
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>