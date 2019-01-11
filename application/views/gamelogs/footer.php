<script src="<?php echo base_url('assets/plugins/datetimepicker/js/daterangepicker.js'); ?>"></script>

<script>
// Enable date/time picker on datestart field.
$('input[name="date_start"]').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerSeconds": true,
    "autoApply": true,
    "locale": {
        "format": "YYYY/MM/DD HH:mm:ss",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
        "monthNames": [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],
        "firstDay": 1
    },
    "opens": "center"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
});
	
// Enable date picker on dateend field.
$('input[name="date_end"]').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerSeconds": true,
    "autoApply": true,
    "locale": {
        "format": "YYYY/MM/DD HH:mm:ss",
        "separator": " - ",
        "applyLabel": "Apply",
        "cancelLabel": "Cancel",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Su",
            "Mo",
            "Tu",
            "We",
            "Th",
            "Fr",
            "Sa"
        ],
        "monthNames": [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],
        "firstDay": 1
    },
    "opens": "center"
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
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