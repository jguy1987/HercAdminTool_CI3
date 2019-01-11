<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Add Panel User</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('admin/users'); ?>" class="breadcrumb-item">Admin</a>
							<li class="breadcrumb-item active">Add User</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col"></div>
				<div class="col-lg-4">
					<?php echo validation_errors(); ?>
					<?php echo form_open('admin/verifyadduser'); ?>
					<fieldset>
						<div class="form-group">
							<label>Username</label>
							<input type="text" class="form-control" size="40px" name="username" value="" />
						</div>
						<div class="form-group">
							<label>Private Email</label>
							<input type="email" class="form-control" value="" name="pemail" />
						</div>
						<div class="form-group">
							<label>Group Membership</label>
							<select class="form-control" name="group-select">
								<?php foreach ($grouplist as $grpitem): ?>
									<option value="<?php echo $grpitem['id']; ?>"><?php echo $grpitem['name']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Linked game account ID</label>
							<input type="number" class="form-control" size="40px" min="2000000" name="gameacctid" value="" />
							<i>If this user has an in-game account, you can link their in-game account here.</i>
						</div>
						<button type="submit" class="btn btn-default">Add User</button><br />
						<i>Note: Users are added with their logins disabled. You will need to enable them so they can login.</i><br />
						<i>Note: Password will be emailed to the user directly.</i>
					</fieldset>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>