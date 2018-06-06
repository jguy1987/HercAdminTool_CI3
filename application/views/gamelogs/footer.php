<script src="<?php echo base_url('assets/plugins/datetimepicker/js/daterangepicker.js'); ?>"></script>

<script>
// Enable date/time picker on datestart field.
	$(function() {
		$('input[name="date_start"]').daterangepicker({
			singleDatePicker: true,
			timePicker: true,
			autoApply: true,
			showDropdowns: true,
			autoUpdateInput: false,
			locale: {
				format: "YYYY/MM/DD HH:MM:SS",
				separator: "-"
			}
		});
	});
	
// Enable date picker on dateend field.
	$(function() {
		$('input[name="date_end"]').daterangepicker({
			singleDatePicker: true,
			autoApply: true,
			timePicker: true,
			showDropdowns: true,
			locale: {
				format: "YYYY/MM/DD HH:MM:SS",
				separator: "-"
			}
		});
	});
	
//Enable datatable for atcmdResults
	$(document).ready(function() {
		$('#atcmdResults').DataTable( {
		responsive: "yes",
		order: [[0, 'desc']],
		aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );

//Enable datatable for pickResults
	$(document).ready(function() {
		$('#pickResults').DataTable( {
		responsive: "yes",
		order: [[0, 'desc']],
		aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for zenyResults
	$(document).ready(function() {
		$('#zenyResults').DataTable( {
		responsive: "yes",
		order: [[0, 'desc']],
		aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
</script>

</body>
</html>