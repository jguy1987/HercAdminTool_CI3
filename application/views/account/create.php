<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Game Accounts</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Accounts</li>
							<li class="breadcrumb-item active">Create</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<?php echo validation_errors(); ?>
					<?php echo form_open('account/verifycreate'); ?>
					<p>This page will create a game account using the details you provide. The account will be created instantly and a password be emailed to the user. The account will not require any sort of authorization or confirmation.</p>
					<div class="form-group row">
						<label for="acctname" class="col-md-3 col-form-label">Account Name</label>
						<div class="col-md-9">
							<input type="text" class="form-control" id="acctname" name="acctname" />
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-md-3 col-form-label">Email Address</label>
						<div class="col-md-9">
							<input type="email" class="form-control" id="email" name="email" />
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-3 col-form-label">Account Gender</label>
							<div class="col-md-9">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="radio" id="genderM" name="gender" id="gender" value="M" />
											Male
									</label>
								</div>
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="radio" id="genderF" name="gender" id="gender" value="F" />
											Female
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
					<!-- todo: Function to take the groups you have configured in the emulator and list them here -->
						<label for="groupid" class="col-md-3 col-form-label">Group ID</label>
						<div class="col-md-9">
							<input type="number" class="form-control" id="groupid" name="groupid" min="0" max="99" value="0" />
						</div>
					</div>
					<div class="form-group row">
						<label for="birthdate" class="col-md-3 col-form-label">Birthdate</label>
						<div class="col-md-9">
							<input type="text" class="form-control form_date" id="birthdate" name="birthdate" value="<?php date('yyyy-dd-mm'); ?>" />
						</div>
					</div>
					<div class="form-group row">
						<label for="slots" class="col-md-3 col-form-label">Slots Available</label>
						<div class="col-md-9">
							<input type="number" class="form-control" id="slots" name="slots" min="1" max="9" value="9"/>
						</div>
					</div>
					<button type="submit" class="btn btn-default">Register Account</button><br />
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>