	
</body>
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
</html>