<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin Users</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="btn-group">
        <a href="/admin/addadmin"><button type="button" class="btn btn-block bg-gradient-info btn-sm" <?php if ($addAdmin == 0) { echo "disabled"; } ?>>New Admin</button></a>
      </div><br /><br />
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <table id="defaultTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Last Login</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($users as $row) { ?>
                    <tr>
                      <td><?php echo $row['userID']; ?></td>
                      <td><?php echo $row['userName']; ?></td>
                      <td><?php echo $row['userEmail']; ?></td>
                      <td><?php echo $row['userLastLogin']; ?></td>
                      <td><?php if ($row['userDisableLogin'] == 1) { echo "Disabled"; } else { echo "Active"; } ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="/admin/user/<?php echo $row['userID']; ?>"><button type="button" class="btn btn-block bg-gradient-info btn-sm">Edit</button></a>
                          <a href="/admin/resetpass/<?php echo $row['userID']; ?>"><button type="button" class="btn btn-block bg-gradient-warning btn-sm">Reset Password</button></a>
                          <a href="/admin/deleteuser/<?php echo $row['userID']; ?>"><button type="button" class="btn btn-block bg-gradient-danger btn-sm">Delete</button></a>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
