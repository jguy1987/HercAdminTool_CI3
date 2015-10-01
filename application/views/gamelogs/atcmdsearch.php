<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@command log</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); ?>
		<?php echo form_open('gamelogs/atcmdresults'); ?>
			<center>
				<table class="table">
					<tr>
						<td>
							<label>Character Name</label>
						</td>
						<td>
							<input type="text" name="char_name" />
						</td>
					</tr>
					<tr>
						<td>
							<label>@ Command</label>
						</td>
						<td>
							<input type="text" name="atcmd" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Date:</label>
						</td>
						<td>
							<input type="text" class="form_datetime" value="" name="date_start" placeholder="MM-DD-YYYY HH:MM:SS"/>
							&nbsp;to&nbsp;
							<input type="text" class="form_datetime" value="" name="date_end" placeholder="MM-DD-YYYY HH:MM:SS" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Map</label>
						</td>
						<td>
							<input type="text" name="map" />
						</td>
					</tr>
				</table>	
				<div class="row">
					<button type="submit" class="btn btn-success">Submit search</button>
				</div>				
			</center>
		<?php echo form_close(); ?>
	</div>
</div>
