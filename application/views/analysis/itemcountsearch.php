<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Item Count List Search</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<center>
			<?php echo form_open('/analysis/itemcount_result', array('class' => 'form-inline')); ?>
				<p>Input the Item ID you want to search for</p>
				<input type="number" name="inputID" /><br />
				<button type="submit" class="btn btn-primary">Submit Query</button>
			<?php echo form_close(); ?>
		</center>
	</div>
</div>