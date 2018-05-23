<div id="page-wrapper">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Bug Details</h1>
			</div>
		</div>
		<?php if (empty($bug_details)) { ?>
			<div class="col-lg-12">
				No bug exists with this ID!
			</div>
		<?php } 
		else { ?>
	</div>
	<a href="/bugtracker/buglist" class="btn btn-info">Return to list</a>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user-md fa-fw"></i> Ticket Information
					</div>
					<div class="panel-body">
					
						<div class="table-responsive">
							<table class="table table-striped" id="dataTables-example">
							<?php echo validation_errors(); ?>
							<?php echo form_open('bugtracker/verifyedit', array('class' => 'form-inline'), array('bug_id' => $bug_details->bug_id)); ?>
								<tr>
									<td><label>Ticket ID</label></td><td><?php echo $bug_details->bug_id; ?></td><td><label>Submitter</label></td><td><?php echo $bug_details->starter_name; ?></td><td><label>Submit Date</label></td><td><?php echo $bug_details->startdate; ?></td>
								</tr>
								<tr>
									<td><label>Ticket Subject</label></td><td colspan="6"><input type="text" class="form-control" name="subject" value="<?php echo $bug_details->title; ?>" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?> /></td>
								</tr>
								<tr>
									<td><label>Status</label></td><td colspan="2">
									<select class="form-control" name="status" id="status" <?php if ($check_perm['changestatus'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_statuses as $s_k => $status): ?>
											<option value="<?php echo $s_k; ?>" <?php if ($s_k == $bug_details->status) { echo "selected"; } ?>><?php echo $status; ?></option>
										<?php endforeach; ?>
									</select></td>
									<td><label>Resolution</label></td><td colspan="2">
									<select class="form-control" name="resolution" id="resolution" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?> <?php if ($bug_details->status != 19) { echo "disabled"; } ?>>
										<option value="-">-</option>
										<?php foreach ($bug_resolutions as $r_k => $resolution): ?>
											<option value="<?php echo $r_k; ?>" <?php if ($r_k == $bug_details->resolution) { echo "selected"; } ?>><?php echo $resolution; ?></option>
										<?php endforeach; ?>
									</select></td>
								</tr>
								<tr>
									<td><label>Priority</label></td><td colspan="2">
									<select class="form-control" name="priority" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_priorities as $p_k => $priority): ?>
											<option value="<?php echo $p_k; ?>" <?php if ($p_k == $bug_details->priority) { echo "selected"; } ?>><?php echo $priority; ?></option>
										<?php endforeach; ?>
									</select></td>
									<td><label>Category</label></td><td colspan="2">
									<select class="form-control" name="category" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_categories as $c_k => $category): ?>
											<option value="<?php echo $c_k; ?>" <?php if ($c_k == $bug_details->category) { echo "selected"; } ?>><?php echo $category; ?></option>
										<?php endforeach; ?>
									</select></td>
								</tr>
								<tr>
									<td><label>Assigned to</label></td><td colspan="2">
									<select class="form-control" name="assigned" id="assigned" <?php if ($check_perm['editbugs'] == 0 || $check_perm['assignbug'] == 0) { echo "readonly"; } ?> <?php if ($bug_details->status != 18) { echo "disabled"; } ?>>
										<option value="-">-</option>
										<?php foreach ($developers as $d_k => $d_v): ?>
											<option value="<?php echo $d_k; ?>" <?php if ($d_k == $bug_details->assigned) { echo "selected"; } ?>><?php echo $d_v; ?>
										<?php endforeach; ?>
									</select></td>
									<td><label>Version</label></td><td colspan="2"><?php echo $bug_details->version; ?></td>
								</tr>
							</table>

						</div>
					<center><button type="submit" class="btn btn-primary">Submit changes</button></center>&nbsp;<br />
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel panel-info">
							<div class="panel-heading"><label>Bug Description</label></div>
							<div class="panel-body"><p><?php echo $bug_details->comment; ?></p></div>
						</div>
						<div class="panel panel-warning">
							<div class="panel-heading"><label>Steps to reproduce</label></div>
							<div class="panel-body"><p><?php echo $bug_details->reproduce; ?></p></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user-md fa-fw"></i> Bug Comments and History
					</div>
					<div class="panel-body">
						<?php foreach($bug_hist_comments as $k=>$v): ?>
							<?php if ($v['type'] == "comment") { ?>
								<div class="panel panel-success">
									<div class="panel-heading"><label><?php echo $users[$v['userid']] ?></label>&nbsp;&nbsp;commented<div style="float: right;"><?php echo $v['datetime']; ?></div></div>
									<div class="panel-body">
										<p><?php echo $v['comment']; ?></p>
									</div>
								</div>
							<?php }
							else if ($v['type'] == "history") { ?>
								<div class="panel panel-info">
									<div class="panel-heading"><label><?php echo $users[$v['userid']]; ?></label>&nbsp;&nbsp;<?php echo $action_types[$v['action_type']]; ?>
									<?php switch( $v['action_type'] ) { 
										case 1: 
											echo $bug_statuses[$v['old_value']]."&nbsp;=>>&nbsp;".$bug_statuses[$v['new_value']];
											break;
										case 2:
											if ($v['old_value'] == NULL) {
												echo "=>>&nbsp;".$developers[$v['new_value']];
											}
											else {
												echo $developers[$v['old_value']]."&nbsp;=>>&nbsp;".$developers[$v['new_value']];
											}
											break;
										case 3:
											echo $bug_priorities[$v['old_value']]."&nbsp;=>>&nbsp;".$bug_priorities[$v['new_value']];
											break;
										case 4:
											echo $bug_categories[$v['old_value']]."&nbsp;=>>&nbsp;".$bug_categories[$v['new_value']];
											break;
										case 5:
											echo $bug_resolutions[$v['old_value']]."&nbsp;=>>&nbsp;".$bug_resolutions[$v['new_value']];
											break;
										case 6:
											echo $v['old_value']."&nbsp;=>>&nbsp;".$v['new_value'];
											break;
										default:
											echo "";
											break;
									} ?>
									<div style="float: right;"><?php echo $v['datetime']; ?></div></div>
								</div>
							<?php } ?>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel-heading"><label>Add new comment</label></div>
						<?php echo form_open('bugtracker/addcomment', array('class' => 'form-inline'), array('bug_id' => $bug_details->bug_id)); ?>
						<div class="panel-body">
							<center><textarea class="form-control" rows="4" cols="120" name="comment"></textarea></center>
						</div>
						<center><button type="submit" class="btn btn-primary">Submit Comment</button></center>&nbsp;<br />
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>