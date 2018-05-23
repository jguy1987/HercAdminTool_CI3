<div id="page-wrapper">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">New Bug</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<?php echo validation_errors(); ?>
		<?php echo form_open('bugtracker/newbug_process'); ?>
		<fieldset>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" size="40px" name="title" value="" />
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label>Priority</label>
						<select class="form-control" name="priority">
							<option value=""></option>
							<?php foreach ($bug_priorities as $p_k => $priority): ?>
								<option value="<?php echo $p_k; ?>"><?php echo $priority; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Category</label>
						<select class="form-control" name="category">
							<option value=""></option>
							<?php foreach ($bug_categories as $c_k => $category): ?>
								<option value="<?php echo $c_k; ?>"><?php echo $category; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Version</label>
						<select class="form-control" name="version">
							<option value=""></option>
							<?php foreach ($bug_versions as $v_k => $version): ?>
								<option value="<?php echo $version; ?>"><?php echo $version; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-4">	
					<div class="form-group">
						<label>View Status</label>&nbsp;&nbsp;&nbsp;
						<input type="radio" name="view-status" value="public" checked <?php if ($check_perm['makeprivate'] == 0) { echo "readonly"; } ?> />&nbsp;Public&nbsp;&nbsp;<input type="radio" name="view-status" value="private" <?php if ($check_perm['makeprivate'] == 0) { echo "readonly"; } ?> />&nbsp;Private
					</div>
					<div class="form-group">
						<label>Server</label><br />
						<select class="form-control" name="server">
							<option value=""></option>
							<?php foreach ($servers as $s_k => $server): ?>
								<option value="<?php echo $s_k; ?>"><?php echo $server['servername']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="form-group">
					<label>Description of Bug/Suggestion</label>
					<textarea class="form-control" name="comment" id="comment" rows="4"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="form-group">
					<label>Steps to reproduce</label>
					<textarea class="form-control" name="reproduce" id="reproduce" rows="4"></textarea>
				</div>
			</div>
		</fieldset>
		<button type="submit" class="btn btn-default">Submit Bug</button>
		<?php echo form_close(); ?>
	</div>
</div>