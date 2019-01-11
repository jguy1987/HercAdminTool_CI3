<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Add Panel Group</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('admin/groups'); ?>" class="breadcrumb-item">Admin</a>
							<li class="breadcrumb-item active">Add Group</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<?php echo validation_errors(); ?>
					<?php echo form_open('admin/verifygroupadd'); ?>
					<fieldset>
						<div class="form-group row">
							<label class="col-form-label col-md-3">Group Name</label>
							<div class="col-md-3">
								<input class="form-control" size="40px" name="grpname" value="" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-3">Group ID</label>
							<div class="col-md-3">
								<input type="number" class="form-control" min="1" max="99" value="" name="groupid" />
							</div>
						</div>
						<div class="row">
							<div class="col-lg-3">
								<label>Account Module Permissions</label><br />
								<?php foreach($permissions['account'] as $perm=>$text): ?>
									<?php if ($perm == "acctgroupmax") { ?>
										<input type="number" name="perm[<?php echo $perm; ?>]" value="" />&nbsp;<?php echo $text; ?><br />
									<?php } else { ?>
										<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
									<?php } ?>
								<?php endforeach; ?>
							</div>
							<div class="col-lg-3">
								<label>Character Module Permissions</label><br />
								<?php foreach($permissions['character'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
							<div class="col-lg-3">
								<label>Admin Panel Module Permissions</label><br />
								<?php foreach($permissions['admin'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
							<div class="col-lg-3">
								<label>Bugtracker Module Permissions</label><br />
								<?php foreach($permissions['bugtracker'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-lg-3">
								<label>Ticket Module Permissions</label><br />
								<?php foreach($permissions['ticket'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
							<div class="col-lg-3">
								<label>Server Setting Module Permissions</label><br />
								<?php foreach($permissions['server'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
							<div class="col-lg-3">
								<label>Log Module Permissions</label><br />
								<?php foreach($permissions['log'] as $perm=>$text): ?>
									<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
								<?php endforeach; ?>
							</div>
						</div>
						<br />
						<button type="submit" class="btn btn-default">Add Group</button>
					</fieldset>
				</div>
			</div>
		</div>
	</div>
</div>