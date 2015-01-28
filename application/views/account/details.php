<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Account Details/Edit</h1>
			</div>
		</div>
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#details" data-toggle="tab">Basic Info</a></li>
			<li><a href="#blocks" data-toggle="tab">Account Blocks</a></li>
			<li><a href="#notes" data-toggle="tab">Notes</a></li>
			<li><a href="#history" data-toggle="tab">History</a></li>
			<li><a href="#characters" data-toggle="tab">Characters</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="details">
				<h4>Basic Account Info</h4>
				<?php echo validation_errors(); ?>
				<?php echo form_open('/account/verifyedit', array('class' => 'form-inline')); ?>
				<fieldset>
					<div class="row">
						<div class="cold-lg-12">
							<center><h3>General Account Info</h3></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Account ID</label></td>
									<td width="200px"><?php echo $acct_data->account_id; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Create Date</label></td>
									<td width="200px"><?php echo $acct_data->createdate; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Account Name</label></td>
									<td width="200px"><?php echo $acct_data->userid; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Gender</label></td>
									<td width="200px"><label class="radio-inline">
									<input type="radio" name="gender" id="optionsRadiosInline1" value="M" <?php if ($acct_data->sex == "M") { echo "checked"; } ?> <?php if ($check_perm['editgender'] == 0) { echo "disabled"; } ?>/>Male
									</label>
									<label class="radio-inline">
									<input type="radio" name="gender" id="optionsRadiosInline2" value="F" <?php if ($acct_data->sex == "F") { echo "checked"; } ?> <?php if ($check_perm['editgender'] == 0) { echo "disabled"; } ?> />Female
									</label></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Email Address</label></td>
									<td width="200px"><input class="form-control" size="40px" name="email" value="<?php echo $acct_data->email; ?>" <?php if ($check_perm['editacctemail'] == 0) { echo "disabled"; } ?> /></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>GroupID</label></td>
									<td width="200px"><input class="form-control" size="40px" name="groupid" value="<?php echo $acct_data->group_id; ?>" <?php if ($check_perm['editacctgroup'] == 0) { echo "disabled"; } ?> /></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Last Login</label></td>
									<td width="200px"><?php echo $acct_data->lastlogin; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Birthdate</label></td>
									<td width="200px"><input type="text" class="form-control form_date" name="birthdate" value="<?php echo $acct_data->birthdate; ?>" <?php if ($check_perm['editacctbd'] == 0) { echo "disabled"; } ?> /></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Character Slots</label></td>
									<td width="200px"><input type="text" class="form-control" name="charslots" value="<?php echo $acct_data->character_slots; ?>" <?php if ($check_perm['editacctslots'] == 0) { echo "disabled"; } ?> /></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
					<div class="row">
						<div class="cold-lg-12">
							<center><h3>Account State Information</h3></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Account Banned?</label></td>
									<td width="200px"><?php if ($acct_data->state == 0) { echo "No"; } ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Ban Expiration Time</label></td>
									<td width="200px"><?php if ($acct_data->state == 0) { echo "Not banned"; } else { echo date('Y-m-d H:i:s', $acct_data->unban_time); } ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Expiration Time</label></td>
									<td width="200px"><?php if ($acct_data->expiration_time == 0) { echo "0"; } else { echo date('Y-m-d H:i:s', $acct_data->expiration_time); } ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<center><h3>Loginlog Information</h3></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Login Count</label></td>
									<td width="200px"><?php echo $acct_data->logincount; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Last IP</label></td>
									<td width="200px"><?php echo $acct_data->last_ip; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Registration IP</label></td>
									<td width="200px"><?php echo $acct_data->register_ip; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Auth IP</label></td>
									<td width="200px"><?php echo $acct_data->auth_ip; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-default">Submit changes</button><br />
				</fieldset>
				<?php echo form_close(); ?>
			</div>
			<div class="tab-pane fade" id="blocks">
				<h4>Block History for Account</h4>
				<div class="row">
					<div align="right"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addBlock">Add New Block</button></div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 125px;">Block Date</th>
									<th style="width: 100px;">Blocked By</th>
									<th style="width: 125px;">Expiry Date</th>
									<th style="width: 100px;">Reason</th>
									<th style="width: 100px;">Unblocked By</th>
									<th style="width: 125px;">Unblocked Date</th>
									<th style="width: 30px;">Block<br />Comment</th>
									<th style="width: 30px;">Unblock<br />Comment</th>
									<th style="width: 100px;">Options</th>
								</tr>
							</thead>
							<tbody>
								<?php if (empty($block_list)) { echo "<tr class='odd gradeX'><td colspan='9'><center>No data!</center></td></tr>"; } ?>
								<?php foreach ($block_list as $bd): ?>
									<tr class="odd gradeX">
										<td><?php echo $bd['blockdate']; ?></td>
										<td><?php echo $bd['blockname']; ?></td>
										<td><?php echo $bd['expiredate']; ?></td>
										<td><?php echo $bd['reason']; ?></td>
										<td><?php echo $bd['ublockname']; ?></td>
										<td><?php echo $bd['unblock_date']; ?></td>
										<td><center><a data-toggle="collapse" data-parent="#accordion" href="#blockcomment<?php echo $bd['blockid']; ?>"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i></button></a></center></td>
										<td><?php if (isset($bd['unblock_date']) == TRUE) { ?><center><a data-toggle="collapse" data-parent="#accordion" href="#ublockcomment<?php echo $bd['blockid']; ?>"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i></button></a></center><?php } ?></td>
										<td></td>
									</tr>
									<tr><td colspan="9">
										<div id="blockcomment<?php echo $bd['blockid']; ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<strong>Block Comment:</strong><br /><?php echo $bd['block_comment']; ?>
											</div>
										</div>
										<div id="ublockcomment<?php echo $bd['blockid']; ?>" class="panel-collapse collapse">
											<div class="panel-body">
												<strong>Unblock Comment:</strong><br /><?php echo $bd['unblock_comment']; ?>
											</div>
										</div>
									</td></tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div align="right"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addBlock">Add New Block</button></div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="addBlock" tabindex="-1" role="dialog" aria-labelledby="addBlockLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="addBlockLabel">Add Block</h4>
						</div>
						<div class="modal-body">
							<?php echo validation_errors(); ?>
							<?php echo form_open('/account/addblock', array('class' => 'form-inline')); ?>
							<table>
								<tr><td width="25%"><label>Type</label></td>
								<td width="450px"><select class="form-control" id="banType" name="banType" style="width:100%;">
									<option value="temp">Temporary</option>
									<option value="perm">Permanent</option>
								</select></td></tr>
								<tr id="banEnd"><td width="25%"><label>Ban Until</label></td>
								<td width="450px"><input type="text" class="form-control form_datetime" value="<?php echo date("Y-m-d H:m:s"); ?>" name="banEnd" style="width:100%;"/></td></tr>
								<tr><td width="25%"><label>Reason</label></td>
								<td width="450px"><select class="form-control" name="reason" style="width:100%;">
									<option>Botting</option>
									<option>Cheating</option>
									<option>Exploiting</option>
									<option>Hacking</option>
									<option>Insult/Harassment</option>
									<option>Real Money Trading</option>
									<option>Security Ban</option>
								</select></td></tr>
								<tr><td width="25%"><label>Comments</label></td>
								<td width="450px"><textarea class="form-control" name="banComments" rows="5" style="width:100%;"></textarea></td></tr>
							</table>
						</div>	
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Add Block</button>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="notes">
				<h4>Notes for Account</h4>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseNotes">Add Note</a>
						</h4>
						<div id="collapseNotes" class="panel-collapse collapse">
							<div class="panel-body">
								<div class="form-group">
									<?php echo validation_errors(); ?>
									<?php echo form_open('/account/addnote', '', array('acct_id' => $acct_data->account_id)); ?>
									<fieldset>
										<textarea class="form-control" rows="3" name="note"></textarea>
										<button type="submit" class="btn btn-default">Add note</button><br />
									</fieldset>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<br />
				<div class="col-md-6 col-md-offset-3">
				<?php foreach($acct_notes as $k): ?>
					<div class="row">
						<div class="panel panel-info">
							<div class="panel-heading">
								<?php echo $k['username']; ?><div style="float: right;"><?php echo $k['datetime']; ?></div>
							</div>
							<div class="panel-body">
								<p><?php echo $k['note']; ?></p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			<div class="tab-pane fade" id="characters">
				<h4>Characters on this Account</h4>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th style="width: 50px;">Slot</th>
									<th style="width: 75px;">CharID</th>
									<th style="width: 100px;">Name</th>
									<th style="width: 30px;">Gender</th>
									<th style="width: 100px;">Class</th>
									<th style="width: 75px;">Base/Job Level</th>
									<th style="width: 100px;">Guild</th>
									<th style="width: 50px;">Online?</th>
									<th style="width: 100px;">Options</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($char_list as $char_data): ?>
									<tr class="odd gradeX">
										<td><?php echo $char_data['char_num']; ?></td>
										<td><a href="/character/details/<?php echo $char_data['char_id']; ?>"><?php echo $char_data['char_id']; ?></a></td>
										<td><?php echo $char_data['name']; ?></td>
										<td><?php echo $char_data['sex']; ?></td>
										<td><?php echo $class_list[$char_data['class']]; ?></td>
										<td><?php echo $char_data['base_level']; ?>/<?php echo $char_data['job_level']; ?></td>
										<td><a href="/guild/details/<?php echo $char_data['guild_id']; ?>"><?php echo $char_data['guild_name']; ?></a></td>
										<td><?php if ($char_data['online'] == 1) { echo "Yes"; } elseif ($char_data['online'] == 0) { echo "No"; }?></td>
										<td>Reset Position</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			