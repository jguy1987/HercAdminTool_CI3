<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="card">
            <div class="card-body">
              <?php switch($page) {
                case "addadmin":
                  echo "The admin user has been added and the welcome email has been sent. If this admin needs immediate access to the panel,
                  please remember to activate their admin account. <a href='/admin/listusers'>Click here</a> to return to the admin list.";
                  break; ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
