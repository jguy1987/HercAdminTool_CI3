<script>
	$(document).ready(function() {
		var table = $('#dataTables-storagelist').DataTable({
			"responsive": true,
			"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
			"searching": false,
			"defaultContent": '',
			"columnDefs": [
				{ "width": '60px', "targets": 0 },
				{ "orderable": false, "targets": 0 },
				{ "width": '100px', "targets": 1 }
			],
		});
	
	// Add event listener for opening and closing details
		$('#dataTables-storagelist tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
				$('div.slider', row.child()).slideUp( function () {
				// This row is already open - close it
				row.child.hide();
				tr.removeClass('shown');
				} );
			} 
			else {
				// Open this row
				row.child( content[tr.attr("item_id")] ).show();
				tr.addClass('shown');
				$('div.slider', row.child()).slideDown();
			}
		});
	 });
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listlg').DataTable({
			"responsive": true,
			"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
			"searching": false,
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listsm').DataTable({
			"responsive": true,
			"lengthMenu": [ [10, 20, 50], [10, 20, 50] ],
			"defaultContent": "",
		});
	});
</script>