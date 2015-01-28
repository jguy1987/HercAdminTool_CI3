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
		<?php echo form_open('/admin/verifygroupedit'); ?>
		<fieldset>
			<div class="form-group">
				<label>Group Name</label>
				<input class="form-control" size="40px" name="grpname" value="<?php echo $grpInfo->name; ?>" />
			</div>
			<div class="form-group">
				<label>Group ID</label>
				<input class="form-control" size="40px" name="grpid" value="<?php echo $grpInfo->id; ?>" disabled />
			</div>
			<label>Permissions for this group</label><br />
			<?php $list_perms = array_chunk($permissions, ceil(count($permissions) / 3)); ?>
			<div class="col-lg-4">
				<?php foreach($list_perms[0] as $perm=>$text): ?>
					<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
				<?php endforeach; ?>
			</div>
			<div class="col-lg-4">
				<?php foreach($list_perms[1] as $perm=>$text): ?>
					<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
				<?php endforeach; ?>
			</div>
			<div class="col-lg-4">
				<?php foreach($list_perms[2] as $perm=>$text): ?>
					<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
				<?php endforeach; ?>
			</div>
			<button type="submit" class="btn btn-default">Edit Group</button>
		</fieldset>
		<?php echo form_close(); ?>
	</div>
</div>