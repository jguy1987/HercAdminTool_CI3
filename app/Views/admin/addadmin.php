<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Add Admin</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Add Admin</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <?php if (isset($validation)) { ?>
      <div class="alert alert-warning">
        <h5><i class="icon fas fa-ban"></i> Warning</h5>
        <?php echo $validation->listErrors(); ?>
      </div>
    <?php } ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card">
            <div class="card-body">
              <?php echo form_open("admin/verifyaddadmin"); ?>
              <div class="form-group">
                <label for="userName">Username</label>
                <input type="text" class="form-control" id="userName" placeholder="Username" name="userName" />
              </div>
              <div class="form-group">
                <label for="userEmail">Email Address</label>
                <input type="email" class="form-control" id="userEmail" placeholder="user@example.com" name="userEmail" />
              </div>
              <div class="form-group">
                <label for="userGroup">User Group</label>
                <select class="form-control" name="selectGroup" id="userGroup">
                  <?php foreach ($groupList as $grp) { ?>
									  <option value="<?php echo $grp['groupID']; ?>"><?php echo $grp['groupName']; ?></option>
								  <?php } ?>
                </select>
              </div>
              <i>User will be added with a disabled account. You will need to manually activate their account.</i><br />
              <i>User will receive a randomly generated password via a welcome email.</i>
              <button type="submit" class="btn btn-info btn-block">Add User</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
