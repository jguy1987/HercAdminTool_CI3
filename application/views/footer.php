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
</body>
</html>