<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Zeny log search</h1>
			</div>
		</div>
		<p>Searching all zeny log records. Leave all fields blank to search for all. All fields are wildcard. Use '=' before any string in any field (except between fields) to search specifically in that field.</p>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); ?>
		<?php echo form_open('gamelogs/zeny_results'); ?>
			<center>
				<table class="table">
					<tr>
						<td>	
							<label>Source Character Name:</label>
						</td>
						<td>
							<input type="text" name="source_char_name" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Source Char ID:</label>
						</td>
						<td>
							<input type="number" name="source_char_id" />
							<br /><i>Note: Filling in CharID will override Character Name field.</i>
							<br /><i>Note: Use this field when searching for a mob_id or NPC ID</i>
						</td>
					</tr>
					<tr>
						<td>	
							<label>Destination Character Name:</label>
						</td>
						<td>
							<input type="text" name="dest_char_name" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Destination Char ID:</label>
						</td>
						<td>
							<input type="number" name="dest_char_id" />
							<br /><i>Note: Filling in CharID will override Character Name field.</i>
						</td>
					</tr>
					<tr>
						<td>
							<label>Type:</label>
						</td>
						<td>
							<input type="checkbox" name="type[]" value="M" /> Monster Drop<br />
							<input type="checkbox" name="type[]" value="P" /> Player Drop<br />
							<input type="checkbox" name="type[]" value="T" /> Player Trade<br />
							<input type="checkbox" name="type[]" value="V" /> Player Vend/Take<br />
							<input type="checkbox" name="type[]" value="S" /> Shop Sell/Take<br />
							<input type="checkbox" name="type[]" value="N" /> NPC Give/Take<br />
							<input type="checkbox" name="type[]" value="C" /> Consumed Items<br />
							<input type="checkbox" name="type[]" value="A" /> GM Give/Take<br />
							<input type="checkbox" name="type[]" value="E" /> Mail Attachment<br />
							<input type="checkbox" name="type[]" value="B" /> Buying Store<br />
							<input type="checkbox" name="type[]" value="I" /> Auctioned Items<br />
							<input type="checkbox" name="type[]" value="D" /> Stolen from Monster<br />
							<br /><i>Leave blank to search for all</i>
						</td>
					</tr>
					<tr>
						<td>
							<label>Zeny Amount between</label>
						</td>
						<td>
							<input type="number" name="zeny_low" max="2147483648" />&nbsp;<label>and</label>&nbsp;<input type="number" name="zeny_high" max="2147483649" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Date:</label>
						</td>
						<td>
							<input type="text" class="form_datetime" value="<?php echo $Datetime24prev; ?>" name="date_start" placeholder="YYYY-MM-DD HH:MM:SS"/>
							&nbsp;to&nbsp;
							<input type="text" class="form_datetime" value="<?php echo $curDatetime; ?>" name="date_end" placeholder="YYYY-MM-DD HH:MM:SS" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Map:</label>
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