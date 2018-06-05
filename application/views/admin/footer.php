<script>
//Enable datatable for usersList
	$(document).ready(function() {
		$('#usersList').DataTable();
		responsive: "yes"
	} );
	
//Enable datatable for groupsList
	$(document).ready(function() {
		$('#groupsList').DataTable( {
		responsive: "yes",
		aLengthMenu: [[20, 50, 75, -1], [20, 50, 75, "All"]]
		} );
	} );
	
//Enable datatable for adminloginLog
	$(document).ready(function() {
		$('#adminloginLog').DataTable( {
		responsive: "yes",
		order: [[0, 'desc']],
		} );
	} );

</script>

</body>
</html>