<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="card card-outline card-danger">
            <div class="card-body">
              <?php switch($page) {
                case "addadmindb":
                  echo "The admin was not able to be added due to a database issue. Ensure your panel has the proper access to your
                  MySQL server and that it is running.";
                  break;
                case "addadminemail":
                  echo "The admin was able to be added but it doesn't appear that they got the email. Check your email settings
                  and try again.";
                  break;
                case "permFail":
                  echo "You do not have permission to view this page! <a href='".base_url()."'>Return to the dashboard</a>.";
                  break;
                } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
