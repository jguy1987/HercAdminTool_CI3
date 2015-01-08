<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Add New Admin Panel Group</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
				<div class="col-lg-6">
					<?php echo validation_errors(); ?>
					<?php echo form_open('/admin/verifygroupadd'); ?>
					<fieldset>
						<div class="form-group">
							<label>Group Name</label>
							<input class="form-control" size="40px" name="grpname" value="" />
						</div>
						<div class="form-group">
							<label>Group ID</label>
							<input type="number" class="form-control" min="2" max="98" value="" name="groupid" />
						</div>
						<div class="form-group col-lg-6">
							<label>Permissions for this group</label><br />
							<?php foreach($permissions as $perm=>$text): ?>
								<input type="checkbox" name="perm[<?php echo $perm; ?>]" value="1" />&nbsp;<?php echo $text; ?><br />
							<?php endforeach; ?>
						</div>
						<button type="submit" class="btn btn-default">Add Group</button>
					</fieldset>
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /#page-wrapper -->
			</div>
		<!-- /#wrapper -->