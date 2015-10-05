<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Settings</h1>
			</div>
		</div>
	</div>
	<p>Here you can change the settings for your admin panel account</p>
	<div class="row">
		<div class="col-lg-4">
			<?php echo validation_errors(); ?>
			<?php echo form_open('/user/verifyedit', '', array('userid' => $user_settings->id)); ?>
			<fieldset>
				<div class="form-group">
					<label>Private Email</label>
					<input class="form-control" size="40px" name="pemail" value="<?php echo $user_settings->pemail; ?>" />
				</div>

			</fieldset>
		</div>
		<div class="col-lg-4 col-lg-offset-4">
		
		</div>			
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="form-group">
				<label>Group Membership</label>
				<p>You are part of the <?php echo $user_settings->groupname; ?> group. You may perform the following actions:</p>
				<?php foreach($user_permissions as $v) { ?>
					<p><?php echo $v; ?></p>
				<?php } ?>
			</div>
		</div>
	</div>			
</div>