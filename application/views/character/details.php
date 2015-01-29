<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Character Details/Edit</h1>
			</div>
		</div>
		<ul class="nav nav-tabs" id="myTabs">
			<li class="active"><a href="#details" data-toggle="tab">Basic Info</a></li>
			<li><a href="#items" data-toggle="tab">Items</a></li>
			<li><a href="#log" data-toggle="tab">History</a></li>
			<li><a href="#friends" data-toggle="tab">Friends</a></li>
			<li><a href="#pets" data-toggle="tab">Pet/Homun Info</a></li>
			<li><a href="#skills" data-toggle="tab">Skills</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane fade in active" id="details">
				<h4>Basic Account Info</h4>
				<?php echo validation_errors(); ?>
				<?php echo form_open('/character/verifyedit', array('class' => 'form-inline')); ?>
				<fieldset>
					<div class="row">
						<div class="cold-lg-12">
							<center><h3>General Character Info</h3></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Character Name</label></td>
									<td width="200px"><?php echo $charinfo->name; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Character ID</label></td>
									<td width="200px"><?php echo $charinfo->char_id; ?></td>
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
									<td width="200px"><label>Slot #</label></td>
									<td width="200px"><?php echo $charinfo->char_num + 1; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Account ID</label></td>
									<td width="200px"><?php echo $charinfo->account_id; ?></td>
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
									<td width="200px"><label>Guild Membership</label></td>
									<td width="200px"><?php echo $charinfo->guild_name; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Party</label></td>
									<td width="200px"><?php echo $charinfo->party_name; ?></td>
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
									<td width="200px"><label>Zeny</label></td>
									<td width="200px"><?php echo $charinfo->zeny; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Class</label></td>
									<td width="200px"><?php echo $class_list[$charinfo->class]; ?> </td>
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
									<td width="200px"><label>Last Position</label></td>
									<td width="200px"><?php echo $charinfo->last_map; ?>&nbsp;<?php echo $charinfo->last_x; ?>,&nbsp;<?php echo $charinfo->last_y; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Saved Position</label></td>
									<td width="200px"><?php echo $charinfo->save_map; ?>&nbsp;<?php echo $charinfo->save_x; ?>,&nbsp;<?php echo $charinfo->save_y; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="cold-lg-12">
							<center><h3>Character Stats</h3></center>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Base Level</label></td>
									<td width="200px"><?php echo $charinfo->base_level; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Job Level</label></td>
									<td width="200px"><?php echo $charinfo->job_level; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>HP/MaxHP</label></td>
									<td width="200px"><?php echo $charinfo->hp; ?>/<?php echo $charinfo->max_hp; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>SP/MaxSP</label></td>
									<td width="200px"><?php echo $charinfo->sp; ?>/<?php echo $charinfo->max_sp; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Base Exp</label></td>
									<td width="200px"><?php echo $charinfo->base_exp; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Job Exp</label></td>
									<td width="200px"><?php echo $charinfo->job_exp; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Status Points</label></td>
									<td width="200px"><?php echo $charinfo->status_point; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Skill Points</label></td>
									<td width="200px"><?php echo $charinfo->skill_point; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>STR</label></td>
									<td width="200px"><?php echo $charinfo->str; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>INT</label></td>
									<td width="200px"><?php echo $charinfo->INT; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Hair Style ID</label></td>
									<td width="200px"><?php echo $charinfo->hair; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Hair Color ID</label></td>
									<td width="200px"><?php echo $charinfo->hair_color; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>AGI</label></td>
									<td width="200px"><?php echo $charinfo->agi; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>DEX</label></td>
									<td width="200px"><?php echo $charinfo->dex; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Clothes Color ID</label></td>
									<td width="200px"><?php echo $charinfo->clothes_color; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>Karma/Manner</label></td>
									<td width="200px"><?php echo $charinfo->karma; ?>/<?php echo $charinfo->manner; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>VIT</label></td>
									<td width="200px"><?php echo $charinfo->vit; ?></td>
								</tr>
								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<table>
								<tr>
									<td width="200px"><label>LUK</label></td>
									<td width="200px"><?php echo $charinfo->luk; ?></td>
								</tr>
								</table>
							</div>
						</div>
					</div>
				</fieldset>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>