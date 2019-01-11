<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Bug Details</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('bugtracker/listbugs'); ?>" class="breadcrumb-item">Developer</a>
							<li class="breadcrumb-item active">Bug Details</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php if (empty($bug_details)) { ?>
					<div class="col-lg-12">
						No bug exists with this ID!
					</div>
				<?php } 
				else { ?>
			</div>
			<a href="<?php echo base_url('bugtracker/buglist'); ?>" class="btn btn-info">Return to list</a>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<?php echo validation_errors(); ?>
						<?php echo form_open('bugtracker/verifyedit', array('class' => 'form-inline'), array('bug_id' => $bug_details->bug_id)); ?>
						<div class="card-body">	
							<div class="form-group row">
								<label for="ticket_id" class="col-form-label col-md-2">ID</label>
								<div id="ticket_id" class="col-md-2">
									<?php echo $bug_details->bug_id; ?>
								</div>
								<label for="subject" class="col-form-label col-md-4">Title</label>
								<div class="col-md-4">
									<input type="text" class="form-control" id="subject" name="subject" value="<?php echo $bug_details->title; ?>" <?php if ($check_perm['editbugs'] == 0) { echo "disabled"; } ?> />
								</div>
							</div>
							<div class="form-group row">
								<label for="submitter" class="col-form-label col-md-3">Submitted By</label>
								<div class="col-md-3" id="submitter">
									<?php echo $bug_details->starter_name; ?>
								</div>
								<label for="date" class="col-form-label col-md-3">Submit Date</label>
								<div class="col-md-3" id="date">
									<?php echo $bug_details->startdate; ?>
								</div>
							</div>
							<div class="form-group row">
								<label for="status" class="col-form-label col-md-3">Status</label>
								<div class="col-md-3">
									<select class="form-control" name="status" id="status" <?php if ($check_perm['changestatus'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_statuses as $s_k => $status): ?>
											<option value="<?php echo $s_k; ?>" <?php if ($s_k == $bug_details->status) { echo "selected"; } ?>><?php echo $status; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<label for="priority" class="col-form-label col-md-3">Priority</label>
								<div class="col-md-3">
									<select class="form-control" name="priority" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_priorities as $p_k => $priority): ?>
											<option value="<?php echo $p_k; ?>" <?php if ($p_k == $bug_details->priority) { echo "selected"; } ?>><?php echo $priority; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="category" class="col-form-label col-md-3">Category</label>
								<div class="col-md-3">
									<select class="form-control" name="category" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?>>
										<?php foreach ($bug_categories as $c_k => $category): ?>
											<option value="<?php echo $c_k; ?>" <?php if ($c_k == $bug_details->category) { echo "selected"; } ?>><?php echo $category; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<label for="resolution" class="col-form-label col-md-3">Resolution</label>
								<div class="col-md-3">
									<select class="form-control" name="resolution" id="resolution" <?php if ($check_perm['editbugs'] == 0) { echo "readonly"; } ?> <?php if ($bug_details->status != 19) { echo "disabled"; } ?>>
										<option value="-">-</option>
										<?php foreach ($bug_resolutions as $r_k => $resolution): ?>
											<option value="<?php echo $r_k; ?>" <?php if ($r_k == $bug_details->resolution) { echo "selected"; } ?>><?php echo $resolution; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="assigned" class="col-form-label col-md-3">Assigned To</label>
								<div class="col-md-3">
									<select class="form-control" name="assigned" id="assigned" <?php if ($check_perm['editbugs'] == 0 || $check_perm['assignbug'] == 0) { echo "readonly"; } ?> <?php if ($bug_details->status != 18) { echo "disabled"; } ?>>
										<option value="-">-</option>
										<?php foreach ($developers as $d_k => $d_v): ?>
											<option value="<?php echo $d_k; ?>" <?php if ($d_k == $bug_details->assigned) { echo "selected"; } ?>><?php echo $d_v; ?>
										<?php endforeach; ?>
									</select>
								</div>
								<label for="version" class="col-form-label col-md-3">Version</label>
								<div class="col-md-3" id="version">
									<?php echo $bug_details->version; ?>
								</div>
							</div>
							<center><button type="submit" class="btn btn-primary">Submit changes</button></center>&nbsp;<br />	
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="form-group row">
								<label for="comment" class="col-form-label col-md-3">Bug Description</label>
								<div class="col-md-9" id="comment">
									<?php echo $bug_details->comment; ?>
								</div>
							</div>
							<div class="forum-group row">
								<label for="reproduce" class="col-form-label col-md-3">Steps to Reproduce</label>
								<div class="col-md-9" id="reproduce">
									<?php echo $bug_details->reproduce; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-10">
					<div class="card">
						<div class="card-header">
							<h3>Bug Comments and History</h3>
						</div>
						<div class="card-body">
							<?php foreach($bug_hist_comments as $k=>$v): ?>
								<?php if ($v['type'] == "comment") { ?>
									<div class="card text-white bg-success">
										<div class="card-header text-white">
											<label><?php echo $users[$v['userid']] ?></label>&nbsp;&nbsp;commented<div style="float: right;"><?php echo $v['datetime']; ?></div>
										</div>
										<div class="card-body">
											<?php echo $v['comment']; ?>
										</div>
									</div>
								<?php }
								else if ($v['type'] == "history") { ?>
									<div class="card text-white bg-info">
										<div class="card-header text-white">
											<label><?php echo $users[$v['userid']]; ?></label>&nbsp;&nbsp;<?php echo $action_types[$v['action_type']]; ?>
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
											<div style="float: right;"><?php echo $v['datetime']; ?></div>
										</div>
									</div>
								<?php } ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-header">
							<label>Add New Comment</label>
						</div>
						<div class="card-body">
							<?php echo form_open('bugtracker/addcomment', array('class' => 'form-inline'), array('bug_id' => $bug_details->bug_id)); ?>
							<center><textarea class="form-control" rows="4" cols="120" name="comment"></textarea></center>
							<center><button type="submit" class="btn btn-primary">Submit Comment</button></center>&nbsp;<br />
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="col"></div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>