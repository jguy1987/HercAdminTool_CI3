<script>
//Enable datatable for charlist
	$(document).ready(function() {
		$('#charlist').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for invlist
	$(document).ready(function() {
		$('#invlist').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for cartlist
	$(document).ready(function() {
		$('#cartlist').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for charlogTable
	$(document).ready(function() {
		$('#charlogTable').DataTable( {
			responsive: "yes",
			order: [[0, 'desc']],
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );

//Enable datatable for charhistTable
	$(document).ready(function() {
		$('#charhistTable').DataTable( {
			responsive: "yes",
			order: [[0, 'desc']],
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for onlineList
	$(document).ready(function() {
		$('#onlineList').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
		
	
</script>

</body>
</html>