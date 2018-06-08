<script>
//Enable datatable for inventorylist
	$(document).ready(function() {
		$('#inventoryList').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );

//Enable datatable for storagelist
	$(document).ready(function() {
		$('#storageList').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for level1Zeny
	$(document).ready(function() {
		$('#level1Zeny').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
	
//Enable datatable for noCharsAcct
	$(document).ready(function() {
		$('#noCharsAcct').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );
</script>

</body>
</html>