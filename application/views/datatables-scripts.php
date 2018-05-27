<script>
	$(document).ready(function() {
		var table = $('#dataTables-storagelist').DataTable({
			"responsive": true,
			"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
			"searching": false,
			"bScrollAutoCss": false,
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 0 },
				{ "bSortable": false, "targets": 0 },
				{ "sWidth": '100px', "targets": 1 }
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
				row.child( content_storage[tr.attr("item_id")] ).show();
				tr.addClass('shown');
				$('div.slider', row.child()).slideDown();
			}
		});
	 });
</script>

<script>
	$(document).ready(function() {
		var table = $('#dataTables-charequiplist').DataTable({
			"responsive": true,
			"bPaginate": false,
			"bLengthChange": false,
			"searching": false,
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 0 },
				{ "bSortable": false, "targets": 0 },
				{ "sWidth": '100px', "targets": 1 }
			],
		});
	
	// Add event listener for opening and closing details
		$('#dataTables-charequiplist tbody').on('click', 'td.details-control', function () {
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
				row.child( content_charequip[tr.attr("item_id")] ).show();
				tr.addClass('shown');
				$('div.slider', row.child()).slideDown();
			}
		});
	 });
</script>
<script>
	$(document).ready(function() {
		var table = $('#dataTables-charitemlist').DataTable({
			"responsive": true,
			"bPaginate": false,
			"bLengthChange": false,
			"searching": false,
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 0 },
				{ "bSortable": false, "targets": 0 },
				{ "sWidth": '100px', "targets": 1 }
			],
		});
	
	// Add event listener for opening and closing details
		$('#dataTables-charitemlist tbody').on('click', 'td.details-control', function () {
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
				row.child( content_charitem[tr.attr("item_id")] ).show();
				tr.addClass('shown');
				$('div.slider', row.child()).slideDown();
			}
		});
	 });
</script>
<script>
	$(document).ready(function() {
		var table = $('#dataTables-charcartlist').DataTable({
			"responsive": true,
			"bPaginate": false,
			"bLengthChange": false,
			"searching": false,
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 0 },
				{ "bSortable": false, "targets": 0 },
				{ "sWidth": '100px', "targets": 1 }
			],
		});
	
	// Add event listener for opening and closing details
		$('#dataTables-charcartlist tbody').on('click', 'td.details-control', function () {
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
				row.child( content_charcart[tr.attr("item_id")] ).show();
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
			"bScrollAutoCss": false,
			"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
			"searching": false,
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-acctlist').DataTable({
			responsive: true,
			columns: [ 
			{ responsivePriority: 1 },
			{ responsivePriority: 1 },
			{ responsivePriority: 1 },
			{ responsivePriority: 4 },
			{ responsivePriority: 3 },
			{ responsivePriority: 5 },
			{ responsivePriority: 6 },
			{ responsivePriority: 7 },
			{ responsivePriority: 1 }
			],
			"columnDefs": [
			{ "orderable": false, "targets": 0 },
			{ "orderable": false, "targets": 8 }
			],
			"order": [],
			"lengthMenu": [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listxlg').DataTable({
			"responsive": true,
			"orderClasses": false,
			"bSortClasses": false,
			"bDeferRender": true,
			"bScrollAutoCss": false,
			"lengthMenu": [ [100, 250, 500, -1], [100, 250, 500, "All"] ],
			"searching": false,
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listsm').DataTable({
			"responsive": true,
			"bScrollAutoCss": false,
			"lengthMenu": [ [10, 20, 50], [10, 20, 50] ],
			"defaultContent": '',
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listsm2').DataTable({
			"responsive": true,
			"bScrollAutoCss": false,
			"lengthMenu": [ [10, 20, 50], [10, 20, 50] ],
			"defaultContent": '',
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-charlist').DataTable({
			"responsive": true,
			"bScrollAutoCss": false,
			"paging": false,
			"info": false,
			"defaultContent": '',
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listflags').DataTable({
			"responsive": true,
			"bScrollAutoCss": false,
			"lengthMenu": [ [10, 20, 50], [10, 20, 50] ],
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 1 },
				{ "sWidth": '60px', "targets": 2 }
			],
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-listflags2').DataTable({
			"responsive": true,
			"bScrollAutoCss": false,
			"lengthMenu": [ [10, 20, 50], [10, 20, 50] ],
			"defaultContent": '',
			"aoColumnDefs": [
				{ "sWidth": '60px', "targets": 1 },
				{ "sWidth": '60px', "targets": 2 }
			],
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#dataTables-banlist').DataTable({
			"bScrollAutoCss": true,
			"info": false,
			"defaultContent": '',
		});
	});
</script>