<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Viewing Character</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('character/search'); ?>" class="breadcrumb-item">Character</a>
							<li class="breadcrumb-item active">Detail</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (empty($charinfo)) { ?>
					<div class="col-lg-12">
					No Character exists with this ID!
					</div>
				<?php } else { ?>
				<div class="col-md-12">
					<ul class="nav nav-tabs" id="myTabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Basic Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="itemsTab" data-toggle="tab" href="#items" role="tab" aria-controls="items" aria-selected="false">Items</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="logTab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="false">History</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="friendsTab" data-toggle="tab" href="#friends" role="tab" aria-controls="friends" aria-selected="false">Friends</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="petsTab" data-toggle="tab" href="#pets" role="tab" aria-controls="pets" aria-selected="false">Pets/Homun Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="skillsTab" data-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="false">Skills</a>
						</li>
					</ul>
				</div>
			</div>
		<?php if ($charinfo->online == 1) { ?>
			<div class="alert alert-danger">
				Character is on-line and cannot be edited!
			</div>
		<?php } ?>
		<?php if ($charinfo->delete_date > 0) { ?>
			<div class="alert alert-warning">
				User has initiated the deletion of this character! Initiation time: <?php echo date('Y-m-d H:i:s', $charinfo->delete_date); ?>
			</div>
		<?php } ?>
			<div class="col-md-12 col-xl-12">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="detailsTab">
						<div class="row">
							<div class="col-lg-12">
								<?php echo validation_errors(); ?>
								<?php echo form_open('character/verifyedit', array('class' => 'form-inline'), array('charid' => $charinfo->char_id)); ?>
								<div class="col-md-7">
									<div class="card">
										<div class="card-header">
											<h3><i class="fa fa-user-md fa-fw"></i> General Character Info</h3>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="char_id" class="col-form-label col-md-3">Character ID</label>
												<div class="col-md-3">
													<div id="char_id"><?php echo $charinfo->char_id; ?></div>
												</div>
												<label for="acct_id" class="col-form-label col-md-3">Account ID</label>
												<div class="col-md-3">
													<div id="acct_id"><a href="<?php echo base_url('/account/details/'.$charinfo->account_id.''); ?>"><?php echo $charinfo->account_id; ?></a></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="char_name" class="col-form-label col-md-3">Character Name</label>
												<div class="col-md-3">
													<input type="text" class="form-control" id="char_name" name="char_name" value="<?php echo $charinfo->name; ?>" <?php if ($check_perm['editcharname'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="class" class="col-form-label col-md-3">Class</label>
												<div class="col-md-3">
													<div id="class"><?php echo $class_list[$charinfo->class]; ?></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="create_date" class="col-form-label col-md-3">Create Date</label>
												<div class="col-md-3">
													<div id="create_date"><?php echo $charinfo->create_time; ?></div>
												</div>
												<label for="last_login" class="col-form-label col-md-3">Last Login</label>
												<div class="col-md-3">
													<div id="last_login"><?php echo $charinfo->lastlogin_time; ?></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="char_num" class="col-form-label col-md-3">Slot #</label>
												<div class="col-md-3">
													<input type="number" min="0" max="9" class="form-control" name="char_num" value="<?php echo $charinfo->char_num; ?>"  <?php if ($check_perm['editcharslot'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="zeny" class="col-form-label col-md-3">Zeny</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="zeny" name="zeny" min="0" max="2100000000" value="<?php echo $charinfo->zeny; ?>"  <?php if ($check_perm['editcharzeny'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="hp" class="col-form-label col-md-3">HP&nbsp;/&nbsp;MaxHP</label>
												<div class="col-md-3">
													<div id="hp"><?php echo $charinfo->max_hp; ?>&nbsp;/&nbsp;<?php echo $charinfo->hp; ?></div>
												</div>
												<label for="sp" class="col-form-label col-md-3">SP&nbsp;/&nbsp;MaxSP</label>
												<div class="col-md-3">
													<div id="sp"><?php echo $charinfo->max_sp; ?>&nbsp;/&nbsp;<?php echo $charinfo->sp; ?></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="guild" class="col-form-label col-md-3">Guild</label>
												<div class="col-md-3">
													<div id="guild"><a href="<?php echo base_url('/guild/details/'.$charinfo->guild_id.''); ?>"><?php echo $charinfo->guild_name; ?></a></div>
												</div>
												<label for="party" class="col-form-label col-md-3">Party</label>
												<div class="col-md-3">
													<div id="party"><a href="<?php echo base_url('/party/details/'.$charinfo->party_id.''); ?>"><?php echo $charinfo->party_name; ?></a></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="last_pos" class="col-form-label col-md-3">Last Position</label>
												<div class="col-md-3">
													<div id="last_pos"><?php echo $charinfo->last_map; ?>&nbsp;<?php echo $charinfo->last_x; ?>,&nbsp;<?php echo $charinfo->last_y; ?></div>
												</div>
												<label for="save_pos" class="col-form-label col-md-3">Saved Position</label>
												<div class="col-md-3">
													<div id="save_pos"><?php echo $charinfo->save_map; ?>&nbsp;<?php echo $charinfo->save_x; ?>,&nbsp;<?php echo $charinfo->save_y; ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="card">
										<div class="card-header">
											<h3><i class="fa fa-gear fa-fw"></i> Options</h3>
										</div>
										<div class="card-body">
											<a href="<?php echo base_url('character/kick/'.$charinfo->char_id.''); ?>"><button type="button" class="btn btn-danger">Kick Offline</button></a><br /><br />
											<a href="<?php echo base_url('character/resetpos/'.$charinfo->char_id.''); ?>"><button type="button" class="btn btn-success">Reset Position</button></a><br /><br />
											<button type="button" class="btn btn-warning">Kick from Guild</button><br /><br />
											<button type="button" class="btn btn-warning">Kick from Party</button>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="card">
										<div class="card-header">
											<h3><i class="fa fa-user-md fa-fw"></i> Character Appearance</h3>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="hair" class="col-form-label col-md-6">Hair Style ID</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="hair" name="hair" min="0" max="999" value="<?php echo $charinfo->hair; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="hair" class="col-form-label col-md-6">Hair Color ID</label>
												<div class="col-md-6">
													<input type="number" class="form-control" name="hair_color" min="0" max="999" value="<?php echo $charinfo->hair_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="hair" class="col-form-label col-md-6">Clothes Color ID</label>
												<div class="col-md-6">
													<input type="number" class="form-control" size="40px" name="clothes_color" min="0" max="999" value="<?php echo $charinfo->clothes_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h3><i class="fa fa-user-md fa-fw"></i> Character Level Info</h3>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="base_level" class="col-form-label col-md-3">Base Level</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="base_level" name="base_level" min="1" max="<?php echo $this->config->item('max_base_level'); ?>" value="<?php echo $charinfo->base_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="job_level" class="col-form-label col-md-3">Job Level</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="job_level" name="job_level" min="1" max="<?php echo $this->config->item('max_job_level'); ?>" value="<?php echo $charinfo->job_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="base_exp" class="col-form-label col-md-3">Base Exp</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="base_exp" name="base_exp" min="0" value="<?php echo $charinfo->base_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="job_exp" class="col-form-label col-md-3">Job Exp</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="job_exp" name="job_exp" min="0" value="<?php echo $charinfo->job_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="status_point" class="col-form-label col-md-3">Status Points</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="status_point" name="status_point" min="0" max="99999" value="<?php echo $charinfo->status_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="skill_point" class="col-form-label col-md-3">Skill Points</label>
												<div class="col-md-3">
													<input type="number" class="form-control" name="skill_point" min="0" max="9999" value="<?php echo $charinfo->skill_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card">
										<div class="card-header">
											<h3><i class="fa fa-user-md fa-fw"></i> Character Stats</h3>
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="str" class="col-form-label col-md-3">STR</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="str" name="str" min="1" max="999" value="<?php echo $charinfo->str; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="agi" class="col-form-label col-md-3">AGI</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="agi" name="agi" min="1" max="999" value="<?php echo $charinfo->agi; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="vit" class="col-form-label col-md-3">VIT</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="vit" name="vit" min="1" max="999" value="<?php echo $charinfo->vit; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="dex" class="col-form-label col-md-3">DEX</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="dex" name="dex" min="1" max="999" value="<?php echo $charinfo->dex; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="int" class="col-form-label col-md-3">INT</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="int" name="int" min="1" max="999" value="<?php echo $charinfo->int; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="luk" class="col-form-label col-md-3">LUK</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="luk" name="luk" min="1" max="999" value="<?php echo $charinfo->luk; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="karma" class="col-form-label col-md-3">Karma</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="karma" name="karma" value="<?php echo $charinfo->karma; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="manner" class="col-form-label col-md-3">Manner</label>
												<div class="col-md-3">
													<input type="number" class="form-control" id="manner" name="manner" value="<?php echo $charinfo->manner; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><button type="submit" class="btn btn-primary">Submit changes</button>&nbsp;</center><br />
						<?php echo form_close(); ?>
					</div>
					<div class="tab-pane fade" id="items" role="tabpanel" aria-labelledby="itemsTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-flask fa-fw"></i> Character Items</h3>
								</div>
								<div class="card-body">
									<div class="col-lg-12">
										<div class="card">
											<div class="card-header">
												<strong>Equipped</strong>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover" id="">
														<thead>
															<th></th>
															<th>Equipped to</th>
															<th>ItemID</th>
															<th>Name</th>
															<th>Quantity</th>
															<th>Item Type</th>
															<th>Unique ID</th>
															<th>Options</th>
														</thead>
														<tbody>
															<script>
																var content_charequip = [];
															</script>
															<?php if (is_array($char_items)) { ?>
																<?php foreach ($char_items as $charItem) { ?>
																		<?php if ($charItem['equip'] > 0) { ?>
																			<tr item_id="<?php echo $charItem['id']; ?>">
																				<td class="details-control"></td>
																				<td><?php echo $equipLocation[$charItem['equip']]; ?></td>
																				<td><?php echo $charItem['nameid']; ?></td>
																				<td><?php echo $charItem['name_japanese']; ?></td>
																				<td><?php echo $charItem['amount']; ?></td>
																				<td><?php echo $item_types[$charItem['type']]; ?></td>
																				<td><?php echo $charItem['unique_id']; ?></td>
																				<td>
																					<button type="button" class="btn btn-warning btn-sm">Unequip</button>&nbsp;
																					<button type="button" class="btn btn-danger btn-sm <?php if ($check_perm['editcharitem'] == 0) { echo "disabled"; } ?>">Delete</button>
																				</td>
																			</tr>
																		<?php } ?>
																	<?php
																	if ($charItem['type'] != 4 && $charItem['type'] != 5) {
																		$readonly = "readonly";
																	}
																	else {
																		$readonly = " ";
																	}
																	if ($charItem['attribute'] == 1) {
																		$attribute = "checked";
																	}
																	else {
																		$attribute = " ";
																	}
																	if ($charItem['bound'] == 1) {
																		$bound = "checked";
																	}
																	else {
																		$bound = " ";
																	}
																	if ($check_perm['editcharitem'] == 0 || $charinfo->online > 0) {
																		$disabled = "disabled";
																	}
																	else {
																		$disabled = " ";
																	}
																	$json = "<div class='slider'>".
																		form_open('character/edititem', array('class' => 'form-inline'), array('id' => $charItem['id'], 'item_loc' => "inventory", 'charid' => $charinfo->char_id))."
																			<div class='panel-body'>
																				<div class='row'>
																					<div class='col-xs-3'>
																						<strong>Refine level:</strong>&nbsp;<input type='number' name='refine' class='form-control' value='".$charItem['refine']."' ".$readonly." />
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
																						<strong>Card 1:</strong>&nbsp;<input type='number' name='card0' class='form-control' value='".$charItem['card0']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 2:</strong>&nbsp;<input type='number' name='card1' class='form-control' value='".$charItem['card1']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 3:</strong>&nbsp;<input type='number' name='card2' class='form-control' value='".$charItem['card2']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 4:</strong>&nbsp;<input type='number' name='card3' class='form-control' value='".$charItem['card3']."' ".$readonly." /></br>
																					</div>
																					<button type='submit' class='btn btn-success btn-sm ".$disabled."'>Edit</button>
																				</div>
																			</div>
																		".form_close()."
																	</div>"; ?>
																	<script>
																		content_charequip[<?php echo $charItem["id"]; ?>] = <?php echo json_encode($json); ?>;
																	</script>
																<?php } ?>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="card">
											<div class="card-header">
												<strong>In inventory</strong>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="invlist">
														<thead>
															<th></th>
															<th>ItemID</th>
															<th>Name</th>
															<th>Quantity</th>
															<th>Item Type</th>
															<th>Unique ID</th>
															<th>Options</th>
														</thead>
														<tbody>
															<script>
																var content_charitem = [];
															</script>
															<?php if (is_array($char_items)) { ?>
																<?php foreach ($char_items as $charItem) { ?>
																		<?php if ($charItem['equip'] == 0) { ?>
																			<tr item_id="<?php echo $charItem['id']; ?>">
																				<td class="details-control"></td>
																				<td><?php echo $charItem['nameid']; ?></td>
																				<td><?php echo $charItem['name_japanese']; ?></td>
																				<td><?php echo $charItem['amount']; ?></td>
																				<td><?php echo $item_types[$charItem['type']]; ?></td>
																				<td><?php echo $charItem['unique_id']; ?></td>
																				<td>
																					<button type="button" class="btn btn-warning btn-sm">Unequip</button>&nbsp;
																					<button type="button" class="btn btn-danger btn-sm <?php if ($check_perm['editcharitem'] == 0) { echo "disabled"; } ?>">Delete</button>
																				</td>
																			</tr>
																		<?php } ?>
																	<?php
																	if ($charItem['type'] != 4 && $charItem['type'] != 5) {
																		$readonly = "readonly";
																	}
																	else {
																		$readonly = " ";
																	}
																	if ($charItem['attribute'] == 1) {
																		$attribute = "checked";
																	}
																	else {
																		$attribute = " ";
																	}
																	if ($charItem['bound'] == 1) {
																		$bound = "checked";
																	}
																	else {
																		$bound = " ";
																	}
																	if ($check_perm['editcharitem'] == 0 || $charinfo->online > 0) {
																		$disabled = "disabled";
																	}
																	else {
																		$disabled = " ";
																	}
																	$json = "<div class='slider'>".
																		form_open('character/edititem', array('class' => 'form-inline'), array('id' => $charItem['id'], 'item_loc' => "inventory", 'charid' => $charinfo->char_id))."
																			<div class='panel-body'>
																				<div class='row'>
																					<div class='col-xs-3'>
																						<strong>Refine level:</strong>&nbsp;<input type='number' name='refine' class='form-control' value='".$charItem['refine']."' ".$readonly." />
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
																						<strong>Card 1:</strong>&nbsp;<input type='number' name='card0' class='form-control' value='".$charItem['card0']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 2:</strong>&nbsp;<input type='number' name='card1' class='form-control' value='".$charItem['card1']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 3:</strong>&nbsp;<input type='number' name='card2' class='form-control' value='".$charItem['card2']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 4:</strong>&nbsp;<input type='number' name='card3' class='form-control' value='".$charItem['card3']."' ".$readonly." /></br>
																					</div>
																					<button type='submit' class='btn btn-success btn-sm ".$disabled."'>Edit</button>
																				</div>
																			</div>
																		".form_close()."
																	</div>"; ?>
																	<script>
																		content_charitem[<?php echo $charItem["id"]; ?>] = <?php echo json_encode($json); ?>;
																	</script>
																<?php } ?>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
										<div class="card">
											<div class="card-header">
												<strong>In cart</strong>
											</div>
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="cartlist">
														<thead>
															<th></th>
															<th>ItemID</th>
															<th>Name</th>
															<th>Quantity</th>
															<th>Item Type</th>
															<th>Unique ID</th>
															<th>Options</th>
														</thead>
														<tbody>
															<script>
																var content_charcart = [];
															</script>
															<?php if (is_array($char_cartItems)) { ?>
																<?php foreach ($char_cartItems as $cartItem) { ?>
																	<tr item_id="<?php echo $cartItem['id']; ?>">
																		<td class="details-control"></td>
																		<td><?php echo $cartItem['nameid']; ?></td>
																		<td><?php echo $cartItem['name_japanese']; ?></td>
																		<td><?php echo $cartItem['amount']; ?></td>
																		<td><?php echo $item_types[$cartItem['type']]; ?></td>
																		<td><?php echo $cartItem['unique_id']; ?></td>
																		<td>
																			<button type="button" class="btn btn-warning btn-sm">Unequip</button>&nbsp;
																			<button type="button" class="btn btn-danger btn-sm <?php if ($check_perm['editcharitem'] == 0) { echo "disabled"; } ?>">Delete</button>
																		</td>
																	</tr>
																	<?php
																	if ($cartItem['type'] != 4 && $cartItem['type'] != 5) {
																		$readonly = "readonly";
																	}
																	else {
																		$readonly = " ";
																	}
																	if ($cartItem['attribute'] == 1) {
																		$attribute = "checked";
																	}
																	else {
																		$attribute = " ";
																	}
																	if ($cartItem['bound'] == 1) {
																		$bound = "checked";
																	}
																	else {
																		$bound = " ";
																	}
																	if ($check_perm['editcharitem'] == 0 || $charinfo->online > 0) {
																		$disabled = "disabled";
																	}
																	else {
																		$disabled = " ";
																	}
																	$json = "<div class='slider'>".
																		form_open('character/edititem', array('class' => 'form-inline'), array('id' => $cartItem['id'], 'item_loc' => "cart", 'charid' => $charinfo->char_id))."
																			<div class='panel-body'>
																				<div class='row'>
																					<div class='col-xs-3'>
																						<strong>Refine level:</strong>&nbsp;<input type='number' name='refine' class='form-control' value='".$cartItem['refine']."' ".$readonly." />
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
																						<strong>Card 1:</strong>&nbsp;<input type='number' name='card0' class='form-control' value='".$cartItem['card0']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 2:</strong>&nbsp;<input type='number' name='card1' class='form-control' value='".$cartItem['card1']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 3:</strong>&nbsp;<input type='number' name='card2' class='form-control' value='".$cartItem['card2']."' ".$readonly." /></br>
																					</div>
																					<div class='col-xs-3'>
																						<strong>Card 4:</strong>&nbsp;<input type='number' name='card3' class='form-control' value='".$cartItem['card3']."' ".$readonly." /></br>
																					</div>
																					<button type='submit' class='btn btn-success btn-sm ".$disabled."'>Edit</button>
																				</div>
																			</div>
																		".form_close()."
																	</div>"; ?>
																	<script>
																		content_charcart[<?php echo $cartItem["id"]; ?>] = <?php echo json_encode($json); ?>;
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
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="logTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-history fa-fw"></i> Character Log</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="card">
												<div class="card-header">
													<strong>Character Log</strong>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover" id="charlogTable">
															<thead>
																<th>Datetime</th>
																<th>Type</th>
																<th>Acct ID</th>
																<th>Char Name</th>
																<th>STR / AGI / VIT / INT / DEX / LUK</th>
																<th>Hair / Hair color</th>
															</thead>
															<tbody>
																<?php foreach ($charlog_data as $charLog) { ?>
																	<tr>
																		<td><?php echo $charLog['time']; ?></td>
																		<td><?php echo $charLog['char_msg']; ?></td>
																		<td><a href="<?php echo base_url('account/details/'.$charLog['account_id'].''); ?>#characters"><?php echo $charLog['account_id']; ?></a></td>
																		<td><?php echo $charLog['name']; ?></td>
																		<td><?php echo "".$charLog['str']."&nbsp;/&nbsp;".$charLog['agi']."&nbsp;/&nbsp;".$charLog['vit']."&nbsp;/&nbsp;".$charLog['int']."&nbsp;/&nbsp;".$charLog['dex']."&nbsp;/&nbsp;".$charLog['luk'].""; ?></td>
																		<td><?php echo "".$charLog['hair']."&nbsp;/&nbsp;".$charLog['hair_color'].""; ?></td>
																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="card">
												<div class="card-header">
													<strong>Character Edit History</strong>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover" id="charhistTable">
															<thead>
																<tr>
																	<th style="width: 100px;">Datetime</th>
																	<th style="width: 100px;">User</th>
																	<th style="width: 70px;">Field Changed</th>
																	<th style="width: 75px;">Old Value</th>
																	<th style="width: 75px">New Value</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach($char_edit_hist as $cEH_item): ?>
																	<tr class="odd gradex">
																		<td><?php echo $cEH_item['datetime']; ?></td>
																		<td><?php echo $cEH_item['username']; ?></td>
																		<td><?php echo $cEH_item['chg_attr']; ?></td>
																		<td><?php echo $cEH_item['old_value']; ?></td>
																		<td><?php echo $cEH_item['new_value']; ?></td>
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
						</div>
					</div>
					<div class="tab-pane fade" id="friends" role="tabpanel" aria-labelledby="friendsTab">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h3><i class="fa fa-history fa-fw"></i> Character Log</h3>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="card">
												<div class="card-header">
													<strong>Character Log</strong>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table class="table table-striped table-bordered table-hover" id="dataTables-listsm">
															<thead>
																<th>Friend Char ID</th>
																<th>Character Name</th>
																<th>Account ID</th>
															</thead>
															<tbody>
																<?php foreach ($friends_list as $friend) { ?>
																	<tr>
																		<td><a href="<?php echo base_url('character/details/'.$friend['char_id'].''); ?>"><?php echo $friend['char_id']; ?></a></td>
																		<td><?php echo $friend['name']; ?></td>
																		<td><a href="<?php echo base_url('account/details/'.$friend['friend_account'].''); ?>"><?php echo $friend['friend_account']; ?></a></td>
																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
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