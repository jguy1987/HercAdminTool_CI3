<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">zeny log search</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Game Logs</li>
							<li class="breadcrumb-item active">Zeny</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-6">
					<?php echo validation_errors(); ?>
					<?php echo form_open('gamelogs/zeny_results'); ?>
					<div class="form-group row">
						<label for="source_char_name" class="col-form-label col-md-6">Source Character Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="source_char_name" name="source_char_name" />
						</div>
					</div>
					<div class="form-group row">
						<label for="source_char_id" class="col-form-label col-md-6">Source Character ID</label>
						<div class="col-md-6">
							<input type="number" class="form-control" id="source_char_id" name="source_char_id" />
						</div>
					</div>
					<div class="form-group row">
						<label for="dest_char_name" class="col-form-label col-md-6">Destination Character Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="dest_char_name" name="dest_char_name" />
						</div>
					</div>
					<div class="form-group row">
						<label for="dest_char_id" class="col-form-label col-md-6">Destination Character ID</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="dest_char_id" name="dest_char_id" />
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<label class="col-md-6 col-form-label">Log Type</label>
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
						<label for="dest_char_id" class="col-form-label col-md-6">Zeny amount between</label>
						<div class="col-md-6">
							<input type="number" class="form-control" name="zeny_low" max="2147483648" />&nbsp;<label>and</label>&nbsp;<input type="number" class="form-control" name="zeny_high" max="2147483649" />
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
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
					<?php echo form_close(); ?>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>