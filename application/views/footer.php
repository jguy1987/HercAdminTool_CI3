<?php
?>

<footer class="footer">
	<span class="text-right">
		Powered by <a href="https://github.com/jguy1987/HercAdminTool">Hercules Admin Tool, (c) John Mish</a>
	</span>
	<span class="float-right">
		<small>Page Generated in <?php echo $this->benchmark->elapsed_time();?> seconds</small>
	</span>
</footer>
</div>
<script src="<?php echo base_url('assets/js/modernizr.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/detect.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fastclick.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.nicescroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.scrollTo.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/plugins/waypoints/lib/jquery.waypoints.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/counterup/jquery.counterup.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/switchery/switchery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/pikeadmin.js'); ?>"></script>

<script>
//Enable datatable for tables which don't need any special options
	$(document).ready(function() {
		$('#dt-default').DataTable( {
			responsive: "yes",
			order: [],
		} );
	} );
</script>