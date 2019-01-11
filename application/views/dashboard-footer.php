<script type="text/javascript" src='https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script type="text/javascript">
	var ctx1 = document.getElementById("registrationChart").getContext('2d');
	var barChart = new Chart(ctx1, {
		type: 'line',
		data: {
			labels: [ <?php foreach ($acct_regs as $k=>$v) { ?>"<?php echo $k; ?>", <?php } ?> ],
			datasets: [{
					type: 'line',
					label: 'Registrations',
					borderColor: '#FF2B1A',
					borderWidth: 3,
					fill: false,
					data: [ <?php foreach ($acct_regs as $k=>$v) { ?><?php echo $v; ?>, <?php } ?> ],
				}],
		},
	});
	
</script>

</body>
</html>