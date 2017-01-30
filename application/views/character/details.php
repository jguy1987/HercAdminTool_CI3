<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Character Details/Edit</h1>
			</div>
		</div>
		<?php if (empty($charinfo)) { ?>
			<div class="col-lg-12">
				No character exists with this ID!
			</div>
		<?php }
		else { ?>
			<ul class="nav nav-tabs" id="myTabs">
				<li class="active"><a href="#details" data-toggle="tab">Basic Info</a></li>
				<li><a href="#items" data-toggle="tab">Items</a></li>
				<li><a href="#log" data-toggle="tab">History</a></li>
				<li><a href="#friends" data-toggle="tab">Friends</a></li>
				<li><a href="#pets" data-toggle="tab">Pet/Homun Info</a></li>
				<li><a href="#skills" data-toggle="tab">Skills</a></li>
			</ul>
			<?php if ($charinfo->online == 1) { ?>
				<div class="alert alert-danger">
					Character is online and cannot be edited!
				</div>
			<?php } ?>
			<?php if ($charinfo->delete_date > 0) { ?>
				<div class="alert alert-warning">
					User has initiated the deletion of this character! Initiation time: <?php echo date('Y-m-d H:i:s', $charinfo->delete_date); ?>
				</div>
			<?php } ?>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="details">
					<h4>Basic Character Info</h4><br />
					<?php echo validation_errors(); ?>
					<?php echo form_open('/character/verifyedit', array('class' => 'form-inline'), array('charid' => $charinfo->char_id)); ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-user-md fa-fw"></i> General Character Info
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-8">
												<label>Character Name</label>
											</div>
											<div class="col-sm-4">
												<input type="text" class="form-control" name="char_name" value="<?php echo $charinfo->name; ?>" <?php if ($check_perm['editcharname'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Create Date</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->create_time; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Slot #</label>
											</div>
											<div class="col-sm-4">
												<input type="number" min="0" max="9" class="form-control" name="char_num" value="<?php echo $charinfo->char_num; ?>"  <?php if ($check_perm['editcharslot'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Guild</label>
											</div>
											<div class="col-sm-4">
												<a href="/guild/details/<?php echo $charinfo->guild_id; ?>"><?php echo $charinfo->guild_name; ?></a>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Class</label>
											</div>
											<div class="col-sm-4">
												<?php echo $class_list[$charinfo->class]; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>HP / MaxHP</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->max_hp; ?>&nbsp;/&nbsp;<?php echo $charinfo->hp; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Last Position</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->last_map; ?>&nbsp;<?php echo $charinfo->last_x; ?>,&nbsp;<?php echo $charinfo->last_y; ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-8">
												<label>Character ID</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->char_id; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Last Played</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->lastlogin_time; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Account ID</label>
											</div>
											<div class="col-sm-4">
												<a href="/account/details/<?php echo $charinfo->account_id; ?>"><?php echo $charinfo->account_id; ?></a>
											</div>
										</div>
										<br /><div class="row">
											<div class="col-sm-8">
												<label>Party</label>
											</div>
											<div class="col-sm-4">
												<a href="/party/details/<?php echo $charinfo->party_id; ?>"><?php echo $charinfo->party_name; ?></a>
											</div>
										</div>
										<br /><div class="row">
											<div class="col-sm-8">
												<label>Zeny</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="zeny" min="0" max="2100000000" value="<?php echo $charinfo->zeny; ?>"  <?php if ($check_perm['editcharzeny'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br /><div class="row">
											<div class="col-sm-8">
												<label>SP / MaxSP</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->max_sp; ?>&nbsp;/&nbsp;<?php echo $charinfo->sp; ?>
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-8">
												<label>Saved Position</label>
											</div>
											<div class="col-sm-4">
												<?php echo $charinfo->save_map; ?>&nbsp;<?php echo $charinfo->save_x; ?>,&nbsp;<?php echo $charinfo->save_y; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-9">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-user-md fa-fw"></i> Character Level Info
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-6">
												<label>Base Level</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="base_level" min="1" max="<?php echo $this->config->item('max_base_level'); ?>" value="<?php echo $charinfo->base_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-6">
												<label>Base Exp</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="base_exp" min="0" value="<?php echo $charinfo->base_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-6">
												<label>Status Points</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="status_point" min="0" max="9999" value="<?php echo $charinfo->status_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-6">
												<label>Job Level</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="job_level" min="1" max="<?php echo $this->config->item('max_job_level'); ?>" value="<?php echo $charinfo->job_level; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br /><div class="row">
											<div class="col-sm-6">
												<label>Job Exp</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="job_exp" min="0" value="<?php echo $charinfo->job_exp; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br /><div class="row">
											<div class="col-sm-6">
												<label>Skill Points</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="skill_point" min="0" max="9999" value="<?php echo $charinfo->skill_point; ?>" <?php if ($check_perm['editcharlv'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-user-md fa-fw"></i> Options
								</div>
								<div class="panel-body">
									<a href="/character/kick/<?php echo $charinfo->char_id; ?>"><button type="button" class="btn btn-danger">Kick Offline</button></a>
									<a href="/character/resetpos/<?php echo $charinfo->char_id; ?>"><button type="button" class="btn btn-success">Reset Position</button></a>
								</div>
							</div>
						</div>	
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-user-md fa-fw"></i> Character Stats
								</div>
								<div class="panel-body">
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-4">
												<label>STR</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="str" min="1" max="999" value="<?php echo $charinfo->str; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>AGI</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="agi" min="1" max="999" value="<?php echo $charinfo->agi; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>VIT</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="vit" min="1" max="999" value="<?php echo $charinfo->vit; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>Manner</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="manner" value="<?php echo $charinfo->manner; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-sm-4">
												<label>INT</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="int" min="1" max="999" value="<?php echo $charinfo->int; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>DEX</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="dex" min="1" max="999" value="<?php echo $charinfo->dex; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>LUK</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="luk" min="1" max="999" value="<?php echo $charinfo->luk; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
										<br />
										<div class="row">
											<div class="col-sm-4">
												<label>Karma</label>
											</div>
											<div class="col-sm-4">
												<input type="number" class="form-control" name="karma" value="<?php echo $charinfo->karma; ?>" <?php if ($check_perm['editcharstats'] == 0) { echo "readonly"; } ?> />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									<i class="fa fa-user-md fa-fw"></i> Character Appearance
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-8">
											<label>Hair Style ID</label>
										</div>
										<div class="col-sm-4">
											<input type="number" class="form-control" name="hair" min="0" max="999" value="<?php echo $charinfo->hair; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
									<br />
									<div class="row">
										<div class="col-sm-8">
											<label>Hair Color ID</label>
										</div>
										<div class="col-sm-4">
											<input type="number" class="form-control" name="hair_color" min="0" max="999" value="<?php echo $charinfo->hair_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
									<br />
									<div class="row">
										<div class="col-sm-8">
											<label>Clothes Color ID</label>
										</div>
										<div class="col-sm-4">
											<input type="number" class="form-control" size="40px" name="clothes_color" min="0" max="999" value="<?php echo $charinfo->clothes_color; ?>" <?php if ($check_perm['editcharlook'] == 0) { echo "readonly"; } ?> />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<br />
					<center><button type="submit" class="btn btn-primary">Submit changes</button>&nbsp;</center><br />
					<?php echo form_close(); ?>
				</div>
				<div class="tab-pane fade in" id="items">
					<h4>Character Item Information</h4><br />
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>Equipped</strong>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-charequiplist">
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
													form_open('/character/edititem', array('class' => 'form-inline'), array('id' => $charItem['id'], 'item_loc' => "inventory", 'charid' => $charinfo->char_id))."
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
										</tbody>
									</table>
								</div>
							</div>													
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>In inventory</strong>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-charitemlist">
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
													form_open('/character/edititem', array('class' => 'form-inline'), array('id' => $charItem['id'], 'item_loc' => "inventory", 'charid' => $charinfo->char_id))."
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
										</tbody>
									</table>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<strong>In cart</strong>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-charcartlist">
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
													form_open('/character/edititem', array('class' => 'form-inline'), array('id' => $cartItem['id'], 'item_loc' => "cart", 'charid' => $charinfo->char_id))."
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
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>				
				</div>
				<div class="tab-pane fade in" id="log">
					<h4>Character Log</h4><br />
					<div class="row">
						<h4>Character Log</h4>
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-listsm">
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
												<td><a href="/account/details/<?php echo $charLog['account_id']; ?>#characters"><?php echo $charLog['account_id']; ?></a></td>
												<td><?php echo $charLog['name']; ?></td>
												<td><?php echo "".$charLog['str']."&nbsp;/&nbsp;".$charLog['agi']."&nbsp;/&nbsp;".$charLog['vit']."&nbsp;/&nbsp;".$charLog['INT']."&nbsp;/&nbsp;".$charLog['dex']."&nbsp;/&nbsp;".$charLog['luk'].""; ?></td>
												<td><?php echo "".$charLog['hair']."&nbsp;/&nbsp;".$charLog['hair_color'].""; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<h4>Character Edit History</h4>
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover" id="dataTables-listsm2">
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
				<div class="tab-pane fade in" id="friends">
					<h4>Character Friends</h4><br />
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
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
												<td><a href="/character/details/<?php echo $friend['char_id']; ?>"><?php echo $friend['char_id']; ?></a></td>
												<td><?php echo $friend['name']; ?></td>
												<td><a href="/account/details/<?php echo $friend['friend_account']; ?>"><?php echo $friend['friend_account']; ?></a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>						
			</div>
		<?php } ?>
	</div>
</div>