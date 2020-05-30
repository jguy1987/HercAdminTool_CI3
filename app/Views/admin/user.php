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
    <?php echo form_open("admin/user/".$userID."", '', ['submit' => True]); ?>
      <div class="container-fluid">
        <?php if ($userDisableLogin == 1) { ?>
          <div class="col-md-12">
            <div class="callout callout-info">
              <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;This user is disabled from logging in.
            </div>
          </div>
        <?php } ?>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admin Information</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="adminID">UserID</label>
                  <input type="text" class="form-control" id="adminID" name="adminID" value="<?php echo $userID; ?>" disabled />
                </div>
                <div class="form-group">
                  <label for="adminName">Username</label>
                  <input type="text" class="form-control" id="adminName" name="adminName" value="<?php echo $userName; ?>" />
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
                    <button type="submit" class="btn btn-primary btn-block">Save changes</button>
                  </td></tr>
                  <tr><td>
                    <a href="/admin/resetpass/<?php echo $userID; ?>"><button type="button" class="btn btn-warning btn-block">Reset Password</button></a>
                  </td></tr>
                  <tr><td>
                    <a href="/admin/chgstatus/<?php echo $userID; ?>">
                      <button type="button" class="btn btn-<?php if ($userDisableLogin == 1) { echo "success"; } else { echo "warning"; } ?> btn-block">
                        <?php if ($userDisableLogin == 1) { echo "Enable Login"; } else { echo "Disable Login"; } ?>
                      </button>
                    </a>
                  </td></tr>
                  <tr><td>
                    <a href="/admin/deluser/<?php echo $userID; ?>"><button type="button" class="btn btn-danger btn-block">Delete User</button></a>
                  </td></tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Group Information</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="groupSelect">Group</label>
                  <select class="custom-select" name="mailProto" id="mailProto">
                    <?php foreach ($groupList as $grpitem) { ?>
                      <option value="<?php echo $grpitem['groupID']; ?>" <?php if ($userGroupID == $grpitem['groupID']) { echo "selected"; } ?>><?php echo $grpitem['groupName']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <a href=""><button type="submit" class="btn btn-info btn-block">Group Information</button></a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Login Information</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Last Login</label><br />
                  <?php echo $userLastLogin; ?>
                </div>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="vacationMode" name="vacationMode" <?php if ($userVacationMode == 1) { echo "checked"; } ?> />
                  <label class="form-check-label" for="vacationMode">Vacation Mode</label>
                </div>
                <?php if ($userVacationMode == 1) { ?>
                  <div class="form-group">
                    <label>Vacation Mode Since</label><br />
                    <?php echo $userVacationSince; ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Login Logs (last 5)</h3>
              </div>
              <div class="card-body">
                <table class="table table-bordered text-center">
                  <tr>
                    <th>Date/Time</th>
                    <th>IP</th>
                  </tr>
                  <?php foreach ($loginLog as $login) { ?>
                    <tr>
                      <td><?php echo $login['loginTime']; ?></td>
                      <td><?php echo $login['loginIP']; ?></td>
                    </tr>
                  <?php } ?>
                </table><br />
                <a href="/admin/viewloginlogs/<?php echo $userID; ?>"><button type="submit" class="btn btn-primary btn-block">View full log</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
</div>
