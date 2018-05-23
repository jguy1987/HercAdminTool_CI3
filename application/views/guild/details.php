<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Guild Details/Edit</h1>
			</div>
		</div>
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#details" data-toggle="tab">Basic Info</a></li>
			<li><a href="#members" data-toggle="tab">Members</a></li>
			<li><a href="#storage" data-toggle="tab">Storage</a></li>
			<li><a href="#ranks" data-toggle="tab">Ranks</a></li>
			<li><a href="#castles" data-toggle="tab">Castle Info</a></li>
			<li><a href="#alliances" data-toggle="tab">Aliiances</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="details">
				<h4>Basic Guild Info</h4><br />
				<?php echo validation_errors(); ?>
				<?php echo form_open('guild/verifyedit', array('class' => 'form-inline'), array('guild_id' => $guildinfo->guild_id)); ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> General Guild Info
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped" id="dataTables-example">
										<tr>
											<td><label>Guild Name</label></td><td><input type="text" class="form-control" name="guild_name" value="<?php echo $guildinfo->name; ?>" <?php if ($check_perm['editguildname'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Guild ID</label></td><td><?php echo $guildinfo->guild_id; ?></td>
										</tr>
										<tr>
											<td><label>Guild Master</label></td><td><a href="<?php echo base_url('character/details/'.$guildinfo->char_id.''); ?>"><?php echo $guildinfo->master; ?></td>
											<td><label>Average Level</label></td><td><?php echo $guildinfo->average_lv; ?></td>
										</tr>
										<tr>
											<td><label>Level</label></td><td><input type="number" class="form-control" min="1" max="50" name="guild_lv" value="<?php echo $guildinfo->guild_lv; ?>" <?php if ($check_perm['editguildlv'] == 0) { echo "readonly"; } ?> /></td>
											<td><label>Exp</label></td><td><input type="number" class="form-control" name="guild_exp" value="<?php echo $guildinfo->exp; ?>" <?php if ($check_perm['editguildlv'] == 0) { echo "readonly"; } ?> /></td>
										</tr>
										<tr>
											<td><label>Members</label></td><td><?php echo $guildinfo->member_cnt; ?></td>
											<td><label>Max Members</label></td><td><?php echo $guildinfo->max_member; ?></td>
										</tr>
										<tr>
											<td><label>Guild Emblem</label></td><td>Picture here</td>
											<td><label>Options</label><td><button type="button" class="btn btn-warning">Empty</button>&nbsp;<button type="button" class="btn btn-danger">Delete</button></td>
										</tr>
									</table>
								</div>
								<center><button type="submit" class="btn btn-info">Submit Changes</button></center>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade in" id="members">
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-user-md fa-fw"></i> Guild Members
							</div>
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover" id="dataTables-example">
										<thead>
											<tr>
												<th>Char Name</th>
												<th>Rank</th>
												<th>Account ID</th>
												<th>Class</th>
												<th>Base Level</th>
												<th>Online?</th>
												<th>Options</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($guildMembers as $member) { ?>
												<tr>
													<td><a href="<?php echo base_url('character/details/'.$member['char_id'].''); ?>"><?php echo $member['name']; ?></a></td>
													<td><?php echo $guildPositions[$member['position']]['name']; ?>&nbsp;(<?php echo $member['position']; ?>)</td>
													<td><a href="<?php echo base_url('account/details/'.$member['account_id'].''); ?>"><?php echo $member['account_id']; ?></a></td>
													<td><?php echo $class_list[$member['class']]; ?></td>
													<td><?php echo $member['lv']; ?></td>
													<td><?php if ($member['online'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
													<td><?php echo form_open('guild/leaderassign', '', array('guild_id' => $guildinfo->guild_id, 'new_leader_name' => $member['name'], 'old_leader_id' => $guildinfo->char_id, 'new_leader_id' => $member['char_id'])); ?><button type="submit" class="btn btn-info">Promote</button><?php echo form_close(); ?></td>
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