<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		 <div class="row">
			  <div class="col-lg-12">
					<h1 class="page-header">Create Account</h1>
			  </div>
			  <!-- /.col-lg-12 -->
		 </div>
		 <!-- /.row -->
	<p>This page is used to create an account for the GAME through the backend. Such an account will not require email authorization. The password and pincode will be automatically generated and sent to the user.</p>
	<div class="col-lg-3">
		<?php echo validation_errors(); ?>
		<?php echo form_open('/account/verifycreate'); ?>
		<fieldset>
			<div class="form-group">
				<label>Account Name</label>
				<input class="form-control" size="40px" name="acctname" />
			</div>
			<div class="form-group">
				<label>Email Address</label>
				<input class="form-control" size="40px" name="email" />
			</div>
			<div class="form-group">
				<label>Account Gender</label>
				<label class="radio-inline">
				<input type="radio" name="gender" id="optionsRadiosInline1" value="M" />Male
				</label>
				<label class="radio-inline">
				<input type="radio" name="gender" id="optionsRadiosInline2" value="F" />Female
				</label>
			</div>
			<div class="form-group">
			<!-- todo: Function to take the groups you have configured in the emulator and list them here -->
				<label>Group ID</label>
				<input type="number" class="form-control" name="groupid" min="0" max="99" value="0"/>
			</div>
			<div class="form-group">
				<label>Birthdate</label>
				<input type="text" class="form-control" name="birthdate" value="yyyy-mm-dd" data-date-format="yyyy-mm-dd"  />
			</div>
			<div class="form-group">
				<label>Slots Available</label>
				<input type="number" class="form-control" name="slots" min="1" max="9" value="9"/>
			</div>
			<button type="submit" class="btn btn-default">Register Account</button><br />
		</fieldset>
		<?php echo form_close(); ?>
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->