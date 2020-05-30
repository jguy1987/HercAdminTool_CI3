<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php if ($editGroup == 0 || $grpInfo['groupID'] >= $userGroupID ) { ?>
      <div class="alert alert-warning">
        <h5><i class="icon fas fa-ban"></i> Warning</h5>
        <?php echo "You do not have permission to edit this group."; ?>
      </div>
    <?php } ?>
    <?php if (isset($validation)) { ?>
      <div class="alert alert-warning">
        <h5><i class="icon fas fa-ban"></i> Warning</h5>
        <?php echo $validation->listErrors(); ?>
      </div>
    <?php } ?>
    <?php if (isset($changeConfirm)) { ?>
      <?php if ($changeConfirm == TRUE) { ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Success</h5>
        <p>The changes have been saved.</p>
      </div>
      <?php } else { ?>
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
          <p>The changes could not be saved at this time.</p>
        </div>
      <?php } ?>
    <?php } ?>
    <?php echo form_open("admin/group/{$grpInfo['groupID']}", '', ['submit' => True]); ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Group Information</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="groupID">Group ID</label>
                  <input type="text" class="form-control" id="groupID" name="groupID" value="<?php echo $grpInfo['groupID']; ?>" />
                </div>
                <div class="form-group">
                  <label for="groupName">Group Name</label>
                  <input type="text" class="form-control" id="groupName" name="groupName" value="<?php echo $grpInfo['groupName']; ?>" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Commands</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered text-center">
                  <tr><td>
                    <button type="submit" class="btn btn-primary btn-block" <?php if ($editGroup == 0 || $grpInfo['groupID'] >= $userGroupID ) { echo "disabled"; } ?>>Save changes</button>
                  </td></tr>
                  <tr><td>
                    <a href="/admin/delgroup/<?php echo $grpInfo['groupID']; ?>"><button type="button" class="btn btn-danger btn-block" <?php if ($editGroup == 0 || $grpInfo['groupID'] >= $userGroupID ) { echo "disabled"; } ?>>Delete Group</button></a>
                  </td></tr>
                </table>
              </div>
            </div>
          </div>
        </div>
        <p><strong>Select permissions for this group below. Hover over each permission to view more information.</strong></p>
        <div class="row">
          <?php foreach ($perms as $module=>$key) { ?>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><?php echo $module; ?> Module Permissions</h3>
                </div>
                <div class="card-body">
                  <?php foreach($key as $k=>$v) { ?>
                    <div class="form-check">
                      <input type="hidden" name="perm[<?php echo $k; ?>]" value="0" />
                      <input type="checkbox" class="form-check-input" id="<?php echo $k; ?>" name="perm[<?php echo $k; ?>]" value="1"<?php if ($grpInfo[$k] == "1") { echo "checked"; } ?> />
                      <label class="form-check-label" for="<?php echo $k; ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $v[0]; ?>"><?php echo $k; ?></label>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </form>
  </section>
</div>
