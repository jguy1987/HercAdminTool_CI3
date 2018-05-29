<script src="<?php echo base_url('assets/plugins/datetimepicker/js/daterangepicker.js'); ?>"></script>
<!-- Enable date picker on Birthdate field. -->
<script>
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
</script>
<!-- Get ID and send to modal on block tab --> 
<script type="text/javascript">
	$(function() {
		$(document).on('click','#delBlockOpen',function(e){
			$('#blockidval').val($(this).data('id'));
		});
	});
</script>

</body>
</html>