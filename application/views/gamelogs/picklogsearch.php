<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">pick log search</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Game Logs</li>
							<li class="breadcrumb-item active">pick</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-6">
					<?php echo validation_errors(); ?>
					<?php echo form_open('gamelogs/pick_results'); ?>
					<div class="form-group row">
						<label for="char_name" class="col-form-label col-md-6">Character Name</label>
						<div class="col-md-6">
							<input type="text" id="char_name" class="form-control" name="char_name" />
						</div>
					</div>
					<div class="form-group row">
						<label for="char_id" class="col-form-label col-md-6">Char ID</label>
						<div class="col-md-6">
							<input type="number" id="char_id" class="form-control" name="char_id" />
							<br /><i>Note: Filling in CharID will override Character Name field.</i>
						</div>
					</div>
					<div class="form-group row">
						<label for="item_id" class="col-form-label col-md-6">Item ID</label>
						<div class="col-md-6">
							<input type="number" id="item_id" class="form-control" name="item_id" />
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-6 col-form-label">Pick Type</label>
							<div class="col-md-6">
								<?php foreach ($type_list as $k=>$v): ?>
								<div class="form-check">
									<label class="form-check-label">
										<input class="form-check-input" type="checkbox" name="type[]" value="<?php echo $k; ?>" /> <?php echo $v; ?>
									</label>
								</div>
								<?php endforeach; ?>
								<i>Leave blank to search for all</i>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="date" class="col-form-label col-md-6">Date Range</label>
						<div class="col-md-6" id="date">
							<label>Start:</label><input type="text" class="form-control form_date" id="date_start" name="date_start" value="" /><br />
							<label>End:</label><input type="text" class="form-control form_date" id="date_end" name="date_end" value="<?php date('yyyy-dd-mm hh:mm:ss'); ?>" />
						</div>
					</div>
					<div class="form-group row">
						<label for="map" class="col-form-label col-md-6">Map</label>
						<div class="col-md-6">
							<input type="text" id="map" class="form-control" name="map" />
						</div>
					</div>
					<div class="form-group row">
						<label for="unique_id" class="col-form-label col-md-6">Unique ID</label>
						<div class="col-md-6">
							<input type="number" id="unique_id" class="form-control" name="unique_id" />
						</div>
					</div>
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
					<?php echo form_close(); ?>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>