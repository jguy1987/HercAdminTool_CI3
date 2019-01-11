<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Item Count Analysis</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Analysis</li>
							<li class="breadcrumb-item active">Item Count</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-6">
					<?php echo form_open('analysis/itemcount_result', array('class' => 'form-inline')); ?>
						<div class="form-group row">
							<label class="col-form-label col-md-6">Input the Item ID you want to search for</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="inputID" />
							</div>
						</div>
						<div class="row">
							<center><button type="submit" class="btn btn-primary">Submit Query</button></center>
						</div>
					<?php echo form_close(); ?>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>