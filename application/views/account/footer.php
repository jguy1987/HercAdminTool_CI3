<script src="<?php echo base_url('assets/plugins/datetimepicker/js/daterangepicker.js'); ?>"></script>


<script>
// Enable date picker on Birthdate field.
	$(function() {
		$('input[name="birthdate"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true,
			locale: {
				format: "YYYY/MM/DD",
				separator: "-"
			}
		});
	});
	
// Get ID and send to modal on block tab
	$(function() {
		$(document).on('click','#delBlockOpen',function(e){
			$('#blockidval').val($(this).data('id'));
		});
	});
	
//Enable datatable for acctlist
	$(document).ready(function() {
		$('#acctlist').DataTable();
		responsive: "yes"
	} );
	
//Enable datatable for storagelist
	$(document).ready(function() {
		$('#storagelist').DataTable();
		responsive: "yes"
	} );

</script>

</body>
</html>