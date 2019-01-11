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
							<li class="breadcrumb-item active">Search</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<?php echo form_open('account/resultlist'); ?>
						<div class="form-group row">
							<label for="acct_id" class="col-sm-3 col-form-label">Account ID</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="acct_id" />
							</div>
						</div>
						<div class="form-group row">
							<label for="acct_name" class="col-sm-3 col-form-label">Account Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="acct_name" />
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 col-form-label">Email Address</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" id="email" />
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<label class="col-sm-3 col-form-label">Gender</label>
								<div class="col-sm-9">
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="gender" id="gender" value="M" />
												Male
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label">
											<input class="form-check-input" type="radio" name="gender" id="gender" value="F" />
												Female
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="isBanned" value="1"> Is Banned?
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="isGM" value="1"> Is GM?
									</label>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary">Submit Search</button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>	
				<div class="col-md-2">
				</div>
			</div>
		</div>
	</div>
</div>
		