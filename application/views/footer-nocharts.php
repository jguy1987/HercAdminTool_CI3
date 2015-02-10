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
</body>
</html>