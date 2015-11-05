<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Pick log search</h1>
			</div>
		</div>
		<p>Searching all pick log records. Leave all fields blank to search for all. All fields are wildcard. Use '=' before any string in any field (except card ID) to search specifically in that field.</p>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); ?>
		<?php echo form_open('gamelogs/pick_results'); ?>
			<center>
				<table class="table">
					<tr>
						<td>
							<label>Character Name:</label>
						</td>
						<td>
							<input type="text" name="char_name" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Char ID:</label>
						</td>
						<td>
							<input type="number" name="char_id" />
							<br /><i>Note: Filling in CharID will override Character Name field.</i>
						</td>
						
					<tr>
						<td>
							<label>Item ID:</label>
						</td>
						<td>
							<input type="number" name="item_id" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Type:</label>
						</td>
						<td>
							<input type="checkbox" name="type[]" value="M" /> Monster Drop<br />
							<input type="checkbox" name="type[]" value="P" /> Player Drop<br />
							<input type="checkbox" name="type[]" value="L" /> Mob Loot Drop/Take<br />
							<input type="checkbox" name="type[]" value="T" /> Player Trade<br />
							<input type="checkbox" name="type[]" value="V" /> Player Vend/Take<br />
							<input type="checkbox" name="type[]" value="S" /> Shop Sell/Take<br />
							<input type="checkbox" name="type[]" value="N" /> NPC Give/Take<br />
							<input type="checkbox" name="type[]" value="C" /> Consumed Items<br />
							<input type="checkbox" name="type[]" value="A" /> GM Give/Take<br />
							<input type="checkbox" name="type[]" value="R" /> Storage<br />
							<input type="checkbox" name="type[]" value="G" /> Guild Storage<br />
							<input type="checkbox" name="type[]" value="E" /> Mail Attachment<br />
							<input type="checkbox" name="type[]" value="B" /> Buying Store<br />
							<input type="checkbox" name="type[]" value="O" /> Produced Items/Ingredients<br />
							<input type="checkbox" name="type[]" value="I" /> Auctioned Items<br />
							<input type="checkbox" name="type[]" value="X" /> Other<br />
							<input type="checkbox" name="type[]" value="D" /> Stolen from Monster<br />
							<input type="checkbox" name="type[]" value="U" /> MVP prizes<br />
							<br /><i>Leave blank to search for all</i>
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
					<tr>
						<td>
							<label>With card ID:</label>
						</td>
						<td>
							<input type="text" name="card_id" />
							<br /><i>Note: This search not working yet</i>
						</td>
						
					</tr>
					<tr>
						<td>
							<label>Unique ID:</label>
						</td>
						<td>
							<input type="number" name="unique_id" />
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