<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Game Characters</h1>
			</div>
		</div>
	</div>
	<p>In-game character search. Searches are wildcarded. Use "=" sign before any search term to search for that string exactly. Leave all fields blank to search for all.</p>
	<div class="panel-body">
			<?php echo form_open('character/resultlist', array('class' => 'form-inline')); ?>
				<center>
					<table class="table">
						<tr>
							<td>
								<label>Char ID</label>
							</td>
							<td>
								<input type="text" name="char_id" />
							</td>
						</tr>
						<tr>
							<td>
								<label>Char Name</label>
							</td>
							<td>
								<input type="text" name="char_name" />
							</td>
						</tr>
						<tr>
							<td>
								<label>Job</label>
							</td>
							<td>
								<select class="form-control" name="class" style="width:50%;">
									<option value="">Select One</option>
									<?php foreach($class_list as $cID=>$cName) { ?>
										<option value="<?php echo $cID; ?>"><?php echo $cName; ?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Base Level</label>
							</td>
							<td>
								&le;<input type="number" name="ltbLevel" style="max-width:100px;">&nbsp;&nbsp;
								&ge;<input type="number" name="gtbLevel" style="max-width:100px;">
							</td>
						</tr>
						<tr>
							<td>
								<label>Gender</label>
							</td>
							<td>
								<input type="radio" name="gender" id="optionsRadiosInline1" value="M" />&nbsp;Male&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" id="optionsRadiosInline2" value="F" />&nbsp;Female&nbsp;&nbsp;&nbsp;
								<input type="radio" name="gender" id="optionsRadiosInline3"	value="U" />&nbsp;Account Specific
							</td>
						</tr>
						<tr>
							<td>
								<label>Job Level</label>
							</td>
							<td>
								&le;<input type="number" name="ltjLevel" style="max-width:100px;">&nbsp;&nbsp;
								&ge;<input type="number" name="gtjLevel" style="max-width:100px;">
							</td>
						</tr>
					</table>
					<button type="submit" class="btn btn-success">Submit search</button>
				</center>
			<?php echo form_close(); ?>
			<br />