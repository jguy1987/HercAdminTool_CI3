<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin Groups</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item">Admin</li>
            <li class="breadcrumb-item active">Groups</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="btn-group">
        <a href="/admin/addgroup"><button type="button" class="btn btn-block bg-gradient-info btn-sm" <?php if ($addGroup == 0) { echo "disabled"; } ?>>New Group</button></a>
      </div><br /><br />
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <table id="defaultTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Group ID</th>
                    <th>Group Name</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($groups as $row) { ?>
                    <tr>
                      <td><?php echo $row['groupID']; ?></td>
                      <td><?php echo $row['groupName']; ?></td>
                      <td>
                        <div class="btn-group">
                          <a href="/admin/group/<?php echo $row['groupID']; ?>"><button type="button" class="btn btn-block bg-gradient-info btn-sm">Edit</button></a>
                          <a href="/admin/deletegroup/<?php echo $row['groupID']; ?>"><button type="button" class="btn btn-block bg-gradient-danger btn-sm">Delete</button></a>
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
