<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Panel User Edit</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('admin/users'); ?>" class="breadcrumb-item">Admin</a>
							<li class="breadcrumb-item active">User</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-md-6">
							<?php echo validation_errors(); ?>
							<?php echo form_open('/admin/verifyuser', '', array('userid' => $userinfo->id)); ?>
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-user-md fa-fw"></i> Admin Info</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label for="username" class="col-form-label col-md-6">Account Name</label>
										<div class="col-md-6">
											<input class="form-control" size="40px" id="username" name="username" value="<?php echo $userinfo->username; ?>" />
										</div>
									</div>
									<div class="form-group row">
										<label for="pemail" class="col-form-label col-md-6">Private Email Address</label>
										<div class="col-md-6">
											<input class="form-control" size="40px" name="pemail" value="<?php echo $userinfo->pemail; ?>" />
										</div>
									</div>
									<div class="form-group row">
										<label for="gameacctid" class="col-form-label col-md-6">Linked Account ID</label>
										<div class="col-md-6">
											<input class="form-control" size="40px" id="gameacctid" name="gameacctid" value="<?php echo $userinfo->gameacctid; ?>" />
											<i>Enter the account ID of the game account for this admin</i>
										</div>
									</div>
									<div class="form-group row">
										<label for="group-select" class="col-form-label col-md-6">Group Membership</label>
										<div class="col-md-6">
											<select class="form-control" id="group-select" name="group-select" <?php if ($userinfo->id == $this->session_data['id']) { echo "disabled"; } ?>>
												<?php foreach ($grouplist as $grpitem): ?>
													<option value="<?php echo $grpitem['id']; ?>" <?php if ($userinfo->groupid == $grpitem['id']) { echo "selected"; } ?>><?php echo $grpitem['name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="form-group row checkbox">
										<label for="active" class="col-form-label col-md-6">
											<input type="checkbox" value="1" id="active" name="active" <?php if ($userinfo->disablelogin != 0) { echo "checked"; } ?> <?php if ($userinfo->id == $this->session_data['id']) { echo "disabled"; } ?> />Disable Login?
										</label>
									</div>
									<div class="form-group row checkbox">
										<label for="vacation" class="col-form-label col-md-6">
											<input type="checkbox" value="1" id="vacation" name="vacation" <?php if ($userinfo->vacation != 0) { echo "checked"; } ?> />Activate Vacation Mode?
											<br />
											<?php if ($userinfo->vacation == 1) { ?>
												Vacation mode has been active since <?php echo $userinfo->vacationsince; ?>.
											<?php } ?>
										</label>
									</div>
									<div class="form-group row checkbox">
										<label for="genpass" class="col-form-label col-md-6">
											<input type="checkbox" value="true" id="genpass" name="genpass"/>Generate new password?
										</label><br />
										<i>Checking this will generate a new 15 character password and send to user</i>
									</div>
									<button type="submit" class="btn btn-default">Process & Save changes</button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h3>Login Logs</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dt-responsive" id="adminloginLog">
											<thead>
												<tr>
													<th>Date/Time</th>
													<th>IP Address</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($loginlog_results as $loginLog): ?>
													<tr>
														<td><?php echo $loginLog['datetime']; ?></td>
														<td><?php echo $loginLog['ip']; ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>