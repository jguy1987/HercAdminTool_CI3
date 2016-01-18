<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Edit Admin Account -> ID = <?php echo $userinfo->id; ?></h1>
			</div>
		</div>
	</div>
	<div class="col-lg-3">
		<?php echo validation_errors(); ?>
		<?php echo form_open('/admin/verifyuser', '', array('userid' => $userinfo->id)); ?>
		<fieldset>
			<div class="form-group">
				<label>Account Name</label>
				<input class="form-control" size="40px" name="username" value="<?php echo $userinfo->username; ?>" />
			</div>
			<div class="form-group">
				<label>Private Email Address</label>
				<input class="form-control" size="40px" name="pemail" value="<?php echo $userinfo->pemail; ?>" />
			</div>
			<div class="form-group">
				<label>Linked Account ID</label>
				<input class="form-control" size="40px" name="gameacctid" value="<?php echo $userinfo->gameacctid; ?>" />
				<i>Enter the account ID of the game account for this admin</i>
			</div>
			<div class="form-group">
				<label>Group Membership</label>
				<select class="form-control" name="group-select">
					<?php foreach ($grouplist as $grpitem): ?>
						<option value="<?php echo $grpitem['id']; ?>" <?php if ($userinfo->groupid == $grpitem['id']) { echo "selected"; } ?>><?php echo $grpitem['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="checkbox">
				<label>
					<?php if ($userinfo->disablelogin != 0) { ?>
						<input type="checkbox" value="1" name="active" checked />Disable Login?
					<?php } else { ?>
						<input type="checkbox" value="1" name="active" />Disable Login?
					<?php } ?>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" value="true" name="genpass"/>Generate new password?
				</label><br />
				<i>Checking this will generate a new 15 character password and send to user</i>
			</div>
			<button type="submit" class="btn btn-default">Process & Save changes</button>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
	<div class="col-lg-6 col-lg-offset-3">
		<h4>Login logs</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listsm2">
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