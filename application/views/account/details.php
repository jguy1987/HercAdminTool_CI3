<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Viewing Account</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('accounts/search'); ?>" class="breadcrumb-item">Accounts</a>
							<li class="breadcrumb-item active">Detail</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (empty($acct_data)) { ?>
					<div class="col-lg-12">
					No Account exists with this ID!
				</div>
			<?php } else { ?>
				<div class="col-md-12">
					<ul class="nav nav-tabs" id="myTabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Basic Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="blocksTab" data-toggle="tab" href="#blocks" role="tab" aria-controls="blocks" aria-selected="false">Account Blocks</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="notesTab" data-toggle="tab" href="#notes" role="tab" aria-controls="notes" aria-selected="false">Notes</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="registerdbTab" data-toggle="tab" href="#flags" role="tab" aria-controls="flags" aria-selected="false">Register DB</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="storageTab" data-toggle="tab" href="#storage" role="tab" aria-controls="storage" aria-selected="false">Storage</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="historyTab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="charactersTab" data-toggle="tab" href="#characters" role="tab" aria-controls="characters" aria-selected="false">Characters</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12 col-xl-12">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="detailsTab">
						<?php echo validation_errors(); ?>
						<?php echo form_open('account/verifyedit', array('class' => 'form-inline'), array('account_id' => $acct_data->account_id)); ?>
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-user-md fa-fw"></i> General Account Info</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label for="acct_id" class="col-form-label col-md-3">Account ID</label>
										<div class="col-sm-9">
											<?php echo $acct_data->account_id; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="acct_name" class="col-form-label col-md-3">Account Name</label>
										<div class="col-sm-9">
											<?php echo $acct_data->userid; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="email" class="col-form-label col-md-3">Email Address</label>
										<div class="col-sm-9">
											<input class="form-control" size="40px" name="email" id="email" value="<?php echo $acct_data->email; ?>" <?php if ($check_perm['editacctemail'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
									<div class="form-group row">
										<label for="lastlogin" class="col-form-label col-md-3">Last Login</label>
										<div class="col-sm-9">
											<?php echo $acct_data->lastlogin; ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="charslots" class="col-form-label col-md-3">Character Reserved Slots</label>
										<div class="col-sm-3">
											<input type="number" min="0" max="9" class="form-control" name="charslots" id="charslots" value="<?php echo $acct_data->character_slots; ?>" <?php if ($check_perm['editacctslots'] == 0) { echo "readonly"; } ?> />
										</div>
										<div class="col-sm-6">
										</div>
									</div>
									<div class="form-group row">
										<label for="createdate" class="col-form-label col-md-3">Create&nbsp;Date</label>
										<div class="col-sm-9">
											<?php echo $reg_data->createdate; ?>
										</div>
									</div>
									<fieldset class="form-group">
										<div class="row">
											<label class="col-form-label col-md-3">Gender</label>
											<div class="col-sm-9">
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="gender" id="genderM" value="M" <?php if ($acct_data->sex == "M") { echo "checked"; } ?> <?php if ($check_perm['editgender'] == 0 && $acct_data->sex == "F") { echo "disabled"; } ?> /> Male
													</label>
												</div>
												<div class="form-check">
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="gender" id="genderF" value="F" <?php if ($acct_data->sex == "F") { echo "checked"; } ?> <?php if ($check_perm['editgender'] == 0 && $acct_data->sex == "M") { echo "disabled"; } ?> /> Female
												</div>
											</div>
										</div>
									</fieldset>
									<div class="form-group row">
										<label for="groupid" class="col-form-label col-md-3">Group ID</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" size="40px" min="0" max="99" name="groupid" id="groupid" value="<?php echo $acct_data->group_id; ?>" <?php if ($check_perm['editacctgroup'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
									<div class="form-group row">
										<label for="birthdate" class="col-form-label col-md-3">Birthdate</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="birthdate" value="<?php echo $acct_data->birthdate; ?>" <?php if ($check_perm['editacctbd'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-cogs fa-fw"></i> Account Options</h3>
								</div>
								<div class="card-body">
									<a href="<?php echo base_url('account/resetpass/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-warning">Reset Password</button></a><br /><br />
									<a href="<?php echo base_url('account/resetpin/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-warning">Reset PIN</button></a><br /><br />
									<a href="<?php echo base_url('account/emailuser/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-info">Send Email</button></a><br /><br />
									<a href="<?php echo base_url('account/kick/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-danger" data-container="body" data-toggle="popover" data-placement="top" data-content="Note this will kick any character logged into this account offline.">Kick Offline</button></a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-unlock fa-fw"></i> Account State</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-form-label col-md-3">Account Banned?</label>
										<div class="col-sm-9">
											<?php if ($acct_data->state == 0 && $acct_data->unban_time == 0) { echo "No"; } else { echo "Yes"; } ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-md-3">Expiration Time</label>
										<div class="col-sm-9">
											<?php if ($acct_data->expiration_time == 0) { echo "0"; } else { echo date('Y-m-d H:i:s', $acct_data->expiration_time); } ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-md-3">Ban Expiration Time</label>
										<div class="col-sm-9">
											<?php if ($acct_data->state == 0 && $acct_data->unban_time == 0) { echo "Not banned"; } elseif ($acct_data->unban_time > 0) { echo date('Y-m-d H:i:s', $acct_data->unban_time); } elseif ($acct_data->state == 5) { echo "Permanent"; } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-th-list fa-fw"></i> Login Information</h3>
								</div>
								<div class="card-body">
									<div class="form-group row">
										<label class="col-form-label col-md-3">Login Count</label>
										<div class="col-sm-3">
											<?php echo $acct_data->logincount; ?>
										</div>
										<label class="col-form-label col-md-3">Last IP</label>
										<div class="col-sm-3">
											<?php echo $acct_data->last_ip; ?>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-form-label col-md-3">Registration IP</label>
										<div class="col-sm-3">
											<?php echo $reg_data->register_ip; ?>
										</div>
										<label class="col-form-label col-md-3">Auth IP</label>
										<div class="col-sm-3">
											<?php echo $reg_data->auth_ip; ?>
										</div>
									</div>
									<?php if ($this->config->item('last_mac_addon') == "yes") { ?>
										<div class="form-group row">
											<label class="col-form-label col-md-3">Last MAC</label>
											<div class="col-sm-3">
												<?php echo $acct_data->last_mac; ?>
											</div>
										</div>	
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<center>
								<button type="submit" class="btn btn-primary">Submit changes</button>
								</center>
						</div>
						<?php echo form_close(); ?>
					</div>
					<div class="tab-pane fade" id="blocks" role="tabpanel" aria-labelledby="blocksTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-gavel fa-fw"></i> Block History</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div align="right"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addBlock" <?php if ($check_perm['banaccount'] == 0) { echo "disabled"; } ?> >Add New Block</button></div>
											<div class="table-responsive">
												<table class="table table-striped table-bordered table-hover" id="dataTables-banlist">
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
														<?php foreach ($block_list as $bd): ?>
														<tr class="odd gradeX">
															<td><?php echo $bd['blockdate']; ?></td>
															<td><?php echo $bd['blockname']; ?></td>
															<td><?php if ($bd['block_type'] == "perm") { echo "Permanent"; } else { echo $bd['expiredate']; } ?></td>
															<td><?php echo $bd['reason']; ?></td>
															<td><?php echo $bd['ublockname']; ?></td>
															<td><?php echo $bd['unblock_date']; ?></td>
															<td><center><a data-toggle="collapse" data-parent="#accordion" href="#blockcomment<?php echo $bd['blockid']; ?>"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i></button></a></center></td>
															<td><?php if (isset($bd['unblock_date']) == TRUE) { ?><center><a data-toggle="collapse" data-parent="#accordion" href="#ublockcomment<?php echo $bd['blockid']; ?>"><button type="button" class="btn btn-primary btn-circle"><i class="fa fa-list"></i></button></a></center><?php } ?></td>
															<td><?php if ($bd['expiredate'] > date('Y-m-d H:i:s') || $bd['block_type'] == "perm") { ?><button type="button" class="btn btn-info" id="delBlockOpen" data-toggle="modal" data-target="#delBlock" data-id="<?php echo $bd["blockid"]; ?>" <?php if ($check_perm['unbanaccount'] == 0 || $bd['unblock_date'] > 0) { echo "disabled"; } ?> >Unblock</button><?php } ?></td>
														</tr>
														<tr><td colspan="9" class="hiddenRow">
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
											<div align="right"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addBlock" <?php if ($check_perm['banaccount'] == 0) { echo "disabled"; } ?> >Add New Block</button></div>
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
												<?php echo form_open('account/addblock', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id)); ?>
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
														<?php foreach($this->config->item('ban_reasons') as $k=>$banReason): ?>
														<option><?php echo $banReason; ?></option>
														<?php endforeach; ?>
													</select></td></tr>
													<tr><td width="25%"><label>Comments</label></td>
													<td width="450px"><textarea class="form-control" name="banComments" rows="5" style="width:100%;"></textarea></td></tr>
												</table>
											</div>	
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Add Block</button>
											</div>
											<?php echo form_close(); ?>
										</div>
									</div>
								</div>
								<div class="modal fade" id="delBlock" tabindex="-1" role="dialog" aria-labelledby="delBlockLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
												<h4 class="modal-title" id="delBlockLabel">Remove Block</h4>
											</div>
											<div class="modal-body">
												<?php echo validation_errors(); ?>
												<?php echo form_open('account/delblock', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id)); ?>
												<input type="hidden" id="blockidval" name="blockidval" />
												<table>
													<tr><td width="25%"><label>Unblock Comment</label></td>
													<td width="450px"><textarea class="form-control" name="unbanComments" rows="5" style="width:100%;"></textarea></td></tr>
												</table>
											</div>
											<center><div style="color:#EE0000; ">Note this will remove the ban with immediate effect.</div></center>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-primary">Remove Block</button>
											</div>
											<?php echo form_close(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notesTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-folder-open-o fa-fw"></i> Account Notes</h3>
								</div>
								<div class="card-body">
									<button type="button" class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseNotes">Add Note</button>
									
									<div id="collapseNotes" class="panel-collapse collapse">
										<div class="panel-body">
											<div class="form-group">
												<?php echo validation_errors(); ?>
												<?php echo form_open('account/addnote', '', array('acct_id' => $acct_data->account_id)); ?>
												<fieldset>
													<textarea class="form-control" rows="3" name="note"></textarea>
													<button type="submit" class="btn btn-default">Add note</button><br />
												</fieldset>
												<?php echo form_close(); ?>
											</div>
										</div>
									</div>
									<br />
									<div class="container">
										<div class="col">
										</div>
										<div class="col-10">
											<?php if (empty($acct_notes)) { ?>
												<div class="card text-white bg-primary">
													<div class="card-body">
														<h4 class="card-title">No notes!</h4>
													</div>
												</div>
											<?php } ?>
											<br />
											<?php foreach($acct_notes as $k): ?>
												<div class="card border-info">
													<div class="card-body">
														<?php echo $k['note']; ?>
													</div>
													<div class="card-footer">
														<?php echo $k['username']; ?><div class="text-right"><?php echo $k['datetime']; ?></div>
													</div>
												</div>
												<br />
											<?php endforeach; ?>
										</div>
										<div class="col">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="flags" role="tabpanel" aria-labelledby="flagsTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-flag fa-fw"></i> Account Flags</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col">
											<div class="card">
												<div class="card-header">
													Num Flags
												</div>
												<div class="card-body">
													<button type="button" class="btn btn-info" id="addNumFlagOpen" data-toggle="modal" data-target="#addNumFlag" data-id="<?php echo $acct_data->account_id; ?>">Add NumFlag</button>
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dt-responsive nowrap">
															<thead>
																<tr>
																	<th>Key Name</th>
																	<th>Index</th>
																	<th>Value</th>
																	<th>Options</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($num_key_list as $nKL_item): ?>
																	<tr class="odd gradex">
																		<td><?php echo $nKL_item['key']; ?></td>
																		<?php echo form_open('account/editnumflag', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id, 'key' => $nKL_item['key'])); ?>
																		<td><input type="number" class="form-control" name="index" value="<?php echo $nKL_item['index']; ?>" /></td>
																		<td><input type="number" class="form-control" name="value" value="<?php echo $nKL_item['value']; ?>" /></td>
																		<td>
																			<button type="submit" class="btn btn-success">Edit</button></a>
																			<?php echo form_close(); ?>&nbsp;
																			<a href="<?php echo base_url('account/delnumflag/'.$nKL_item['key'].'/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
																		</td>
																	</tr>
																<?php endforeach; ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="card">
												<div class="card-header">
													Str Flags
												</div>
												<div class="card-body">
													<button type="button" class="btn btn-info" id="addStrFlagOpen" data-toggle="modal" data-target="#addStrFlag" data-id="<?php echo $acct_data->account_id; ?>">Add StrFlag</button>
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover dt-responsive nowrap">
															<thead>
																<tr>
																	<th>Key Name</th>
																	<th>Index</th>
																	<th>Value</th>
																	<th>Options</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($str_key_list as $sKL_item): ?>
																	<tr class="odd gradex">
																		<td><?php echo $sKL_item['key']; ?></td>
																		<?php echo form_open('account/editstrflag', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id, 'key' => $sKL_item['key'])); ?>
																		<td><input type="number" class="form-control" name="index" value="<?php echo $sKL_item['index']; ?>" /></td>
																		<td><input type="text" class="form-control" name="value" value="<?php echo $sKL_item['value']; ?>" /></td>
																		<td>
																			<button type="submit" class="btn btn-success">Edit</button></a>
																			<?php echo form_close(); ?>&nbsp;
																			<a href="<?php echo base_url('account/delnumflag/'.$sKL_item['key'].'/'.$acct_data->account_id.''); ?>"><button type="button" class="btn btn-danger">Delete</button></a>
																		</td>
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
							</div>
							<div class="modal fade" id="addNumFlag" tabindex="-1" role="dialog" aria-labelledby="addNumFlagLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="addNumFlagLabel">Add Num Flag</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close" />
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?php echo validation_errors(); ?>
											<?php echo form_open('account/addnumflag', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id)); ?>
												<input type="hidden" id="acct_id" name="acct_id" />
												<div class="form-group row">
													<label for="key" class="col-form-label col-md-3">Key&nbsp;Name:</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="key" name="key" />
													</div>
												</div>
												<div class="form-group row">
													<label for="index" class="col-form-label col-md-3">Index:</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="index" name="index" />
													</div>
												</div>
												<div class="form-group row">
													<label for="value" class="col-form-label col-md-3">Value:</label>
													<div class="col-md-9">
														<input type="number" class="form-control" id="value" name="value" />
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Add Flag</button>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
							<div class="modal fade" id="addStrFlag" tabindex="-1" role="dialog" aria-labelledby="addStrFlagLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="addStrFlagLabel">Add Str Flag</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?php echo validation_errors(); ?>
											<?php echo form_open('account/addstrflag', array('class' => 'form-inline'), array('acct_id' => $acct_data->account_id)); ?>
												<input type="hidden" id="acct_id2" name="acct_id" />
												<div class="form-group row">
													<label for="key" class="col-form-label col-md-3">Key&nbsp;Name:</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="key" name="key" />
													</div>
												</div>
												<div class="form-group row">
													<label for="index" class="col-form-label col-md-3">Index:</label>
													<div class="col-md-9">
														<input type="text" class="form-control" id="index" name="index" />
													</div>
												</div>
												<div class="form-group row">
													<label for="value" class="col-form-label col-md-3">Value:</label>
													<div class="col-md-9">
														<input type="number" class="form-control" id="value" name="value" />
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Add Flag</button>
										</div>
										<?php echo form_close(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="storage" role="tabpanel" aria-labelledby="storageTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-bank fa-fw"></i>Items in Storage</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="dt-default" class="table table-striped table-bordered table-hover display dt-responsive nowrap">
											<thead>
												<th></th>
												<th>ItemID</th>
												<th>Name</th>
												<th>Quantity</th>
												<th>Identified?</th>
												<th>Item Type</th>
												<th>Unique ID</th>
												<th>Options</th>
											</thead>
											<tbody>
												<script>
													var content_storage = [];
												</script>
												<?php if (is_array($storage_items)) { ?>
													<?php foreach ($storage_items as $storageItem) { ?>
														<tr item_id="<?php echo $storageItem['id']; ?>">
															<td class="details-control"></td>
															<td><?php echo $storageItem['nameid']; ?></td>
															<td><?php echo $storageItem['name_japanese']; ?></td>
															<td><?php echo $storageItem['amount']; ?></td>
															<td><?php echo $storageItem['identify']; ?></td>
															<td><?php echo $item_types[$storageItem['type']]; ?></td>
															<td><?php echo $storageItem['unique_id']; ?></td>
															<td>
																<button type="button" class="btn btn-danger btn-sm <?php if ($check_perm['editstorageitem'] == 0) { echo "disabled"; } ?>">Delete</button>
															</td>
														</tr>
														<?php
														if ($storageItem['type'] != 4 && $storageItem['type'] != 5) {
															$readonly = "readonly";
														}
														else {
															$readonly = " ";
														}
														if ($storageItem['attribute'] == 1) {
															$attribute = "checked";
														}
														else {
															$attribute = " ";
														}
														if ($storageItem['bound'] == 1) {
															$bound = "checked";
														}
														else {
															$bound = " ";
														}
														if ($check_perm['editstorageitem'] == 0) { 
															$disabled = "disabled"; 
														}
														else {
															$disabled = " ";
														}
														$json = "<div class='slider'>".
															form_open('account/edititem', array('class' => 'form-inline'), array('id' => $storageItem['id'], 'item_loc' => 'inventory', 'acct_id' => $acct_data->account_id))."
																<div class='panel-body'>
																	<div class='row'>
																		<div class='col-xs-3'>
																			<strong>Refine level:</strong>&nbsp;<input type='number' name='refine' class='form-control' value='".$storageItem['refine']."' ".$readonly." />
																		</div>
																		<div class='col-xs-3'>
																			<strong>Broken?:</strong>&nbsp;<input type='checkbox' name='attribute' class='form-control' value='1' ".$attribute." ".$readonly." />
																		</div>
																		<div class='col-xs-3'>
																			<strong>Bound?:</strong>&nbsp;<input type='checkbox' name='bound' class='form-control' value='1' ".$bound." />
																		</div>
																	</div>
																	<br />
																	<div class='row'>
																		<div class='col-xs-3'>
																			<strong>Card 1:</strong>&nbsp;<input type='number' name='card0' class='form-control' value='".$storageItem['card0']."' ".$readonly." /></br>
																		</div>
																		<div class='col-xs-3'>
																			<strong>Card 2:</strong>&nbsp;<input type='number' name='card1' class='form-control' value='".$storageItem['card1']."' ".$readonly." /></br>
																		</div>
																		<div class='col-xs-3'>
																			<strong>Card 3:</strong>&nbsp;<input type='number' name='card2' class='form-control' value='".$storageItem['card2']."' ".$readonly." /></br>
																		</div>
																		<div class='col-xs-3'>
																			<strong>Card 4:</strong>&nbsp;<input type='number' name='card3' class='form-control' value='".$storageItem['card3']."' ".$readonly." /></br>
																		</div>
																		<button type='submit' class='btn btn-success btn-sm ".$disabled."'>Edit</button>
																	</div>
																</div>
															".form_close()."
														</div>"; ?>
														<script>
															content_storage[<?php echo $storageItem["id"]; ?>] = <?php echo json_encode($json); ?>;
														</script>
													<?php } ?>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="historyTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-history fa-fw"></i>Account History</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dt-responsive nowrap">
											<thead>
												<tr>
													<th>Datetime</th>
													<th>User</th>
													<th>Field Changed</th>
													<th>Old Value</th>
													<th>New Value</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($chg_acct_list as $cAL_item): ?>
													<tr class="odd gradex">
														<td><?php echo $cAL_item['datetime']; ?></td>
														<td><?php echo $cAL_item['username']; ?></td>
														<td><?php echo $cAL_item['chg_attr']; ?></td>
														<td><?php echo $cAL_item['old_value']; ?></td>
														<td><?php echo $cAL_item['new_value']; ?></td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="characters" role="tabpanel" aria-labelledby="charactersTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-male fa-fw"></i>Characters</h3>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="dataTables-charlist">
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
														<td><a href="<?php echo base_url('character/details/'.$char_data['char_id'].''); ?>"><?php echo $char_data['char_id']; ?></a>&nbsp;<?php if ($char_data['delete_date'] > 0) { ?><button class="btn btn-danger btn-xs disabled">DELETION PENDING</button><?php } ?></td>
														<td><?php echo $char_data['name']; ?></td>
														<td><?php echo $char_data['sex']; ?></td>
														<td><?php echo $class_list[$char_data['class']]; ?></td>
														<td><?php echo $char_data['base_level']; ?>/<?php echo $char_data['job_level']; ?></td>
														<td><a href="<?php echo base_url('guild/details/'.$char_data['guild_id'].''); ?>"><?php echo $char_data['guild_name']; ?></a></td>
														<td><?php if ($char_data['online'] == 1) { echo "Yes"; } elseif ($char_data['online'] == 0) { echo "No"; }?></td>
														<td><a href="<?php echo base_url('character/resetpos/'.$char_data['char_id'].''); ?>" class="btn btn-sm btn-success <?php if ($char_data['delete_date'] > 0) { echo "disabled"; } ?>">Reset Position</a></td>
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
			</div>
			<?php } ?>
		</div>
	</div>
</div>