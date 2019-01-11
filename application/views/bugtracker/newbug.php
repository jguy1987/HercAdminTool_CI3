<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">New Bug</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('bugtracker/buglist'); ?>" class="breadcrumb-item">Developer</a>
							<li class="breadcrumb-item active">Add Bug</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">	
				<div class="col"></div>
				<div class="col-md-6">
					<?php echo validation_errors(); ?>
					<?php echo form_open('bugtracker/newbug_process'); ?>
						<div class="form-group row">
							<label for="title" class="col-form-label col-md-3">Title</label>
							<div class="col-md-9">
								<input type="text" class="form-control" id="title" size="40px" name="title" value="" />
							</div>
						</div>
						<div class="form-group row">
							<label for="server" class="col-form-label col-md-3">Server</label>
							<div class="col-md-3">
								<select class="form-control" name="server" id="server">
									<option value=""></option>
									<?php foreach ($servers as $s_k => $server): ?>
										<option value="<?php echo $s_k; ?>"><?php echo $server['servername']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<label for="version" class="col-form-label col-md-4">Version</label>
							<div class="col-md-2">
								<select class="form-control" name="version" id="version">
									<option value=""></option>
									<?php foreach ($bug_versions as $v_k => $version): ?>
										<option value="<?php echo $version; ?>"><?php echo $version; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="category" class="col-form-label col-md-3">Category</label>
							<div class="col-md-3">
								<select class="form-control" name="category" id="category">
									<option value=""></option>
									<?php foreach ($bug_categories as $c_k => $category): ?>
										<option value="<?php echo $c_k; ?>"><?php echo $category; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<label for="priority" class="col-form-label col-md-3">Priority</label>
							<div class="col-md-3">
								<select class="form-control" name="priority" id="priority">
									<option value=""></option>
									<?php foreach ($bug_priorities as $p_k => $priority): ?>
										<option value="<?php echo $p_k; ?>"><?php echo $priority; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="form-check">
								<label class="form-check-label col-md-2">
									<input type="checkbox" name="private" value="1" class="form-check-input col-md-2" <?php if ($check_perm['makeprivate'] == 0) { echo "readonly"; } ?> />
								</label>
							</div>
						</div>
						<div class="form-group row">
							<label for="comment" class="col-form-label col-md-3">Description of Bug/Suggestion</label>
							<div class="col-md-9">
								<textarea class="form-control" name="comment" id="comment" rows="5"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="reproduce" class="col-form-label col-md-3">Steps to reproduce</label>
							<div class="col-md-9">
								<textarea class="form-control" name="reproduce" id="reproduce" rows="5"></textarea>
							</div>
						</div>
					<center><button type="submit" class="btn btn-default">Submit Bug</button></center>
					<?php echo form_close(); ?>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>