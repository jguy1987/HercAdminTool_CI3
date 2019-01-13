<script>
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
	
// Get ID and send to modal on news edit
	$(function() {
		$(document).on('click','#editNewsOpen',function(e){
			$('#newsidval').val($(this).data('id'));
		});
	});

</script>

</body>
</html>