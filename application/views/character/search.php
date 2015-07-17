<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Characters</h1>
			</div>
		</div>
	</div>
	<p>Searching in-game characters. Enter your query below or leave blank to show all.</p>
	<div class="panel-body">
			<?php echo form_open('character/resultlist', array('class' => 'form-inline')); ?>
				<div class="row">
					<div class="col-md-3">
						<label>Char ID</label>
						<input type="text" name="char_id" />
					</div>
					<div class="col-md-3">
						<label>Char Name</label>
						<input type="text" name="char_name" />
					</div>
					<div class="col-md-3">
						<label>Job</label>
						<select class="form-control" name="class" style="width:50%;">
							<option value="">Select One</option>
							<?php foreach($class_list as $cID=>$cName) { ?>
								<option value="<?php echo $cID; ?>"><?php echo $cName; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-3">
						<label>Base Level</label>
						<=<input type="number" name="gtbLevel" style="max-width:100px;">&nbsp;>=<input type="number" name="ltbLevel" style="max-width:100px;">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<label>Gender</label>
						<input type="radio" name="gender" id="optionsRadiosInline1" value="M" />Male
						<input type="radio" name="gender" id="optionsRadiosInline2" value="F" />Female
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
						<label>Job Level</label>
						<=<input type="number" name="gtjLevel" style="max-width:100px;">&nbsp;>=<input type="number" name="ltjLevel" style="max-width:100px;">
					</div>
				</div>
				<div class="row">
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
				</div>
			<?php echo form_close(); ?>
			<br />