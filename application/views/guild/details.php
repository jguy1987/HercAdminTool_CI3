<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Guilds</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('guild/search'); ?>" class="breadcrumb-item">Guild</a>
							<li class="breadcrumb-item active">Details</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (empty($guildinfo)) { ?>
					<div class="col-lg-12">
					No Guild exists with this ID!
					</div>
				<?php } else { ?>
				<div class="col-lg-12 col-sm-3">
					<ul class="nav nav-tabs" id="myTabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="detailsTab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Basic Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="membersTab" data-toggle="tab" href="#members" role="tab" aria-controls="members" aria-selected="false">Members</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="storageTab" data-toggle="tab" href="#storage" role="tab" aria-controls="storage" aria-selected="false">Storage</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="ranksTab" data-toggle="tab" href="#ranks" role="tab" aria-controls="ranks" aria-selected="false">Ranks</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="castlesTab" data-toggle="tab" href="#castles" role="tab" aria-controls="castles" aria-selected="false">Castle Info</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="alliancesTab" data-toggle="tab" href="#alliances" role="tab" aria-controls="alliances" aria-selected="false">Alliances</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-12 col-xl-12">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="detailsTab">
						<div class="row">
							<div class="col-lg-12">
								<?php echo validation_errors(); ?>
								<?php echo form_open('guild/verifyedit', array('class' => 'form-inline'), array('guild_id' => $guildinfo->guild_id)); ?>
								<div class="col-md-8">
									<div class="card">
										<div class="card-header">
											<i class="fa fa-users fa-fw"></i> General Guild Info
										</div>
										<div class="card-body">
											<div class="form-group row">
												<label for="guild_name" class="col-form-label col-md-6">Guild Name</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="guild_name" name="guild_name" value="<?php echo $guildinfo->name; ?>" <?php if ($check_perm['editguildname'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="guild_id" class="col-form-label col-md-6">Guild ID</label>
												<div class="col-md-6">
													<div id="guild_id"><?php echo $guildinfo->guild_id; ?></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="guild_master" class="col-form-label col-md-6">Guild Leader</label>
												<div class="col-md-6">
													<div id="guild-master"><a href="<?php echo base_url('character/details/'.$guildinfo->char_id.''); ?>"><?php echo $guildinfo->master; ?></a></div>
												</div>
												<label for="avg_lv" class="col-form-label col-md-6">Average Level</label>
												<div class="col-md-6">
													<div id="avg_lv"><?php echo $guildinfo->average_lv; ?></div>
												</div>
											</div>
											<div class="form-group row">
												<label for="guild_lv" class="col-form-label col-md-6">Guild Level</label>
												<div class="col-md-6">
													<input type="number" class="form-control" min="1" max="50" id="guild_lv" name="guild_lv" value="<?php echo $guildinfo->guild_lv; ?>" <?php if ($check_perm['editguildlv'] == 0) { echo "readonly"; } ?> />
												</div>
												<label for="guild_exp" class="col-form-label col-md-6">Guild Exp</label>
												<div class="col-md-6">
													<input type="number" class="form-control" id="guild_exp" name="guild_exp" value="<?php echo $guildinfo->exp; ?>" <?php if ($check_perm['editguildlv'] == 0) { echo "readonly"; } ?> />
												</div>
											</div>
											<div class="form-group row">
												<label for="members" class="col-form-label col-md-6">Members/Max Members</label>
												<div class="col-md-6">
													<div id="members"><?php echo $guildinfo->member_cnt; ?>&nbsp;/&nbsp;<?php echo $guildinfo->max_member; ?></div>
												</div>
												<label for="emblem" class="col-form-label col-md-6">Emblem</label>
												<div class="col-md-6">
													<div id="emblem"><img src="http://via.placeholder.com/24x24"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<center><button type="submit" class="btn btn-info">Submit Changes</button></center>
						<?php echo form_close(); ?>
					</div>
					<div class="tab-pane fade" id="members" role="tabpanel" aria-labelledby="membersTab">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-header">
									<i class="fa fa-user-md fa-fw"></i> Guild Members
								</div>
								<div class="card-body">
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
			<?php } ?>
		</div>
	</div>
</div>