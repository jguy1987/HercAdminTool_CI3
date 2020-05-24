<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Settings</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <?php if (isset($pwError)) { ?>
      <div class="alert alert-warning">
        <h5><i class="icon fas fa-ban"></i> Warning</h5>
        <p>Incorrect current password.</p>
      </div>
    <?php } ?>
    <?php if (isset($verifyPass)) { ?>
      <div class="alert alert-warning">
        <h5><i class="icon fas fa-ban"></i> Warning</h5>
        <p>The new password and verify password fields do not match.</p>
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
    <?php echo form_open("user/settings", '', ['submit' => True]); ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <div class="card-body">
                <input type="password" class="form-control" name="newUserPass" placeholder="New Password" /><br />
                <input type="password" class="form-control" name="newUserPassVerify" placeholder="Verify New Password">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Change Email</h3>
              </div>
              <div class="card-body">
                <input type="email" class="form-control" name="userEmail" value="<?php echo $userEmail; ?>"/><br />
              </div>
            </div>
          </div>
        </div>
        <!--<div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ticket Handling</h3>
              </div>
              <div class="card-body">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="vacationMode[]" id="vacationMode" />
                  <label class="form-check-label" for="vacationMode">Activate Vacation Mode?</label><br />
                  <small id="vacationModeHelp" class="form-text text-muted">Vacation Mode disables tickets from being assigned to you</small>
                </div>
            </div>
          </div>
        </div>
      </div>-->
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Password Verification</h3>
            </div>
            <div class="card-body">
              Your current password is required to adjust any settings on this page.<br />
              <input type="password" class="form-control" name="userPass" placeholder="Current Password" /><br />
              <button type="submit" class="btn btn-info btn-block">Submit Changes</button>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Available Group Permissions</h3>
            </div>
            <div class="card-body">
              <div class="form-check">
                You are part of the <strong><?php echo $groupName; ?></strong> group and have the following permissions:
              </div>
          </div>
        </div>
      </div>
    </div>
    </form>
  </section>
</div>
