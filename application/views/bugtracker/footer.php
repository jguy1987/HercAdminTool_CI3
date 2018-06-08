<script>
//Enable datatable for bugList
	$(document).ready(function() {
		$('#bugList').DataTable( {
			responsive: "yes",
			aLengthMenu: [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );

</script>

</body>
</html>