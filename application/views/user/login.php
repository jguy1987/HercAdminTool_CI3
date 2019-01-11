<body>
<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">			
		<div class="card">
			<h4 class="card-header">Login</h4>
			<div class="card-body">
				<?php echo validation_errors(); ?>
				<?php echo form_open('verifylogin'); ?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Login Name</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
									<input class="form-control" placeholder="Username" name="username" type="text" autofocus />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<?php echo form_open('verifylogin'); ?>
							<label>Password</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-unlock" aria-hidden="true"></i></span>
									<input class="form-control" placeholder="Password" name="passwd" type="password" value="" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="redirect" value="" />
						<input type="submit" class="btn btn-primary btn-lg btn-block" value="Login" name="submit" />
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</body>