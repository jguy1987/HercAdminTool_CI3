<script>
    $('#myTabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
    });

    // on load of the page: switch to the currently selected tab
    var hash = window.location.hash;
    $('#myTabs a[href="' + hash + '"]').tab('show');
</script>
<script>
var acctregs = [
	<?php foreach ($acct_regs as $k=>$v) { ?>
		{date:"<?php echo $k; ?>", y:"<?php echo $v; ?>"},
	<?php } ?>
	];
new Morris.Line({
	// ID of the element in which to draw the chart.
	element: 'acct-regs',
	// Chart data records -- each entry in this array corresponds to a point on
	// the chart.
	data: acctregs,
	// The name of the data record attribute that contains x-values.
	xkey: 'date',
	// A list of names of data record attributes that contain y-values.
	ykeys: ['y'],
	// Labels for the ykeys -- will be displayed when you hover over the
	// chart.
	labels: ['Value']
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
		$("#banType").change(function() { toggleFields(); });

	});
	//this toggles the visibility of our parent permission fields depending on the current selected value of the field
	function toggleFields() {
		if ($("#banType").val() == "perm") {
			$("#banEnd").hide();
		}
		else {
			$("#banEnd").show();
		}
	}
</script>
<script type="text/javascript">
	$(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
</script>
<script type="text/javascript">
	$(".form_date").datetimepicker({format: 'yyyy-mm-dd'});
</script>
<script type="text/javascript">
	$(function() {
		$(document).on('click','#delBlockOpen',function(e){
			//process here you can get id using 
			$('#blockidval').val($(this).data('id')); //and set this id to any hidden field in modal
		});
	});
</script>
<script type="text/javascript">
	$(function() {
		$(document).on('click','#addNumFlagOpen',function(e){
			//process here you can get id using 
			$('#acct_id').val($(this).data('id')); //and set this id to any hidden field in modal
		});
	});
</script>
<script type="text/javascript">
	$(function() {
		$(document).on('click','#addStrFlagOpen',function(e){
			//process here you can get id using 
			$('#acct_id2').val($(this).data('id')); //and set this id to any hidden field in modal
		});
	});
</script>
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
</body>
</html>