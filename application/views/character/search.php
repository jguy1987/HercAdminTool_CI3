<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Characters</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Characters</li>
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
					<?php echo form_open('character/resultlist'); ?>
					<div class="form-group row">
						<label for="char_id" class="col-sm-3 col-form-label">Character ID</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="char_id" />
						</div>
					</div>
					<div class="form-group row">
						<label for="char_name" class="col-sm-3 col-form-label">Character Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="char_name" />
						</div>
					</div>
					<div class="form-group row">
						<label for="class" class="col-sm-3 col-form-label">Job</label>
						<div class="col-sm-9">
							<select class="form-control" id="class" name="class" style="width:50%;">
								<option value="">Select One</option>
								<?php foreach($class_list as $cID=>$cName) { ?>
									<option value="<?php echo $cID; ?>"><?php echo $cName; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="baselevel" class="col-sm-3 col-form-label">Base Level</label>
						<div class="col-sm-9">
							&le;<input type="number" name="ltbLevel" style="max-width:100px;">&nbsp;&nbsp;&ge;<input type="number" name="gtbLevel" style="max-width:100px;">
						</div>
					</div>
					<div class="form-group row">
						<label for="joblevel" class="col-sm-3 col-form-label">Job Level</label>
						<div class="col-sm-9">
							&le;<input type="number" name="ltjLevel" style="max-width:100px;">&nbsp;&nbsp;&ge;<input type="number" name="gtjLevel" style="max-width:100px;">
						</div>
					</div>
					<button type="submit" class="btn btn-success">Submit search</button>
				</div>
				<?php echo form_close(); ?>
				<div class="col-md-2">
				</div>
			</div>
		</div>
	</div>
</div>