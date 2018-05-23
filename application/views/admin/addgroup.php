<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add New Admin Panel Group</h1>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<?php echo validation_errors(); ?>
		<?php echo form_open('admin/verifygroupadd'); ?>
		<fieldset>
			<div class="form-group">
				<label>Group Name</label>
				<input class="form-control" size="40px" name="grpname" value="" />
			</div>
			<div class="form-group">
				<label>Group ID</label>
				<input type="number" class="form-control" min="1" max="99" value="" name="groupid" />
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