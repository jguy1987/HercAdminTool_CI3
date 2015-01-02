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
				<p>This page is used to create an account for the GAME through the backend. Such an account will not require email authorization. The password will be automatically generated and sent to the user.</p>
				<div class="col-lg-3">
					<?php echo validation_errors(); ?>
					<?php echo form_open('verifyacccreate'); ?>
					<fieldset>
						<div class="form-group">
							<label>Account Name</label>
							<input class="form-control" size="40px" id="acctname" />
						</div>
						<div class="form-group">
							<label>Email Address</label>
							<input class="form-control" size="40px" id="email" />
						</div>
						<div class="form-group">
							<label>Account Gender</label>
							<label class="radio-inline">
								<input type="radio" name="optionsRadiosInline" id="optionsRadiosInline1" value="option1" />Male
							</label>
							<label class="radio-inline">
								<input type="radio" name="optionsRadiosInline" id="optionsRadiosInline2" value="option2" />Female
							</label>
						</div>
						<div class="form-group">
							<label>Group ID</label>
							<select class="form-control" id="groupid">
								<option>0 - Player</option>
								<option>1 - Super Player</option>
								<option>2 - Support</option>
								<option>3 - Script Manager</option>
								<option>4 - Event Manager</option>
								<option>10 - Law Enforcement</option>
								<option>99 - Administrator</option>
							</select>
						</div>
						<div class="form-group">
							<label>Birthdate</label>
							<input type="text" class="form-control" value="mm-dd-yyyy" data-date-format="mm-dd-yyyy" id="birthdate" />
						</div>
						<div class="form-group">
							<label>Slots Available</label>
							<input type="number" class="form-control" min="1" max="9" value="9"/>
						</div>
					</fieldset>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			</div>
		<!-- /#wrapper -->