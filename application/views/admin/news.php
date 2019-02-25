<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Dashboard</h1>
						<ol class="breadcrumb float-right">
							<li class="breadcrumb-item">Home</li>
							<li class="breadcrumb-item">Admin</li>
							<li class="breadcrumb-item active">News</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<a role="button" href="#" class="btn btn-primary" data-toggle="modal" data-target="#addNews">Add Announcement</a>
				<div class="table-responsive"><br />
					<table class="table table-striped table-bordered table-hover display dt-responsive nowrap" id="dt-default">
						<thead>
							<tr>
								<th style="width: 38px;">ID</th>
								<th style="width: 125px;">Username</th>
								<th style="width: 100px;">Posted Date/Time</th>
								<th style="width: 550px;">Content</th>
								<th>Active?</th>
								<th>Pinned?</th>
								<th style="width: 250px;">Options</th>
							</tr>
						</thead>
						<tbody>
							<?php if (empty($admin_news) == false) { ?>
								<?php foreach ($admin_news as $item): ?>
									<tr>
										<td><a href="#" id="editNewsOpen" data-toggle="modal" data-target="#editNews<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>"><?php echo $item['id']; ?></td>
										<td><?php echo $item['username']; ?></td>
										<td><?php echo $item['date']; ?></td>
										<?php $short_content = strlen($item['content']) > 100 ? substr($item['content'],0,100)."..." : $item['content']; ?>
										<td><?php echo $short_content; ?></td>
										<td><?php if ($item['active'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
										<td><?php if ($item['pinned'] == 1) { echo "Yes"; } else { echo "No"; } ?></td>
										<td><a href="<?php echo base_url('admin/deletenews/'.$item['id'].''); ?>"><button type="button" class="btn btn-danger btn-sm">Delete</button></a>&nbsp;</td>
									</tr>
								<div class="modal fade" id="editNews<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editNewsLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title" id="editNewsLabel">Edit Announcement</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
											</div>
											<div class="modal-body">
												<?php echo validation_errors(); ?>
												<?php echo form_open('admin/editnews', array('class' => 'form-inline')); ?>
												<label for="content" class="col-form-label col-md-3">Content</label>
												<div class="col-md-9 col-lg-9">
													<textarea required class="form-control" name="content" id="content" rows="6" style="min-width: 100%"><?php echo $item['content']; ?></textarea>
												</div>
												<input type="hidden" id="newsidval" name="newsid" value="<?php echo $item['id']; ?>" />
												<label for="active" class="col-form-label col-md-3">Make Active?</label>
												<div class="col-md-9">
													<input id="active" type="checkbox" name="active" value="1" <?php if ($item['active'] == 1) { echo "checked"; } ?> />
												</div>
												<label for="pinned" class="col-form-label col-md-3">Pinned?</label>
												<div class="col-md-9">
													<input id="pinned" type="checkbox" name="pinned" value="1" <?php if ($item['pinned'] == 1) { echo "checked"; } ?> />
													<small id="numberlHelp" class="form-text text-muted">Note: Pinned items show up on top by order of submitted.</small>
												</div>
											</div>
											<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Edit News</button>
											</div>
											<?php echo form_close(); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal fade" id="addNews" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="addNewsLabel">Add New Announcement</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<div class="modal-body">
							<?php echo validation_errors(); ?>
							<?php echo form_open('admin/addnews', array('class' => 'form-inline')); ?>
							<label for="content" class="col-form-label col-md-3">Content</label>
							<div class="col-md-9 col-lg-9">
								<textarea required class="form-control" name="content" id="content" rows="6" style="min-width: 100%"></textarea>
							</div>
							<label for="active" class="col-form-label col-md-3">Make Active?</label>
							<div class="col-md-9">
								<input id="active" type="checkbox" name="active" value="1" checked />
							</div>
							<label for="pinned" class="col-form-label col-md-3">Pinned?</label>
							<div class="col-md-9">
								<input id="pinned" type="checkbox" name="pinned" value="1" />
								<small id="numberlHelp" class="form-text text-muted">Note: Pinned items show up on top by order of submitted.</small>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Add News</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
