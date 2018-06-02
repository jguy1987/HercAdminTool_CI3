<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Characters</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('character/search'); ?>" class="breadcrumb-item">Characters</a>
							<li class="breadcrumb-item active">List</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-3">
					<a href="<?php echo base_url('character/search'); ?>" class="btn btn-info">Modify Search</a>
					<?php echo validation_errors(); ?>
					<div class="table-responsive">
						<table id="charlist" class="table table-striped table-bordered table-hover display dt-responsive nowrap">
							<thead>
								<tr>
									<th style="width: 75px;">CharID</th>
									<th style="width: 100px;">Name</th>
									<th style="width: 30px;">Gender</th>
									<th style="width: 100px;">Class</th>
									<th style="width: 75px;">Base/Job Level</th>
									<th style="width: 100px;">Guild</th>
									<th style="width: 100px;">Party</th>
									<th style="width: 50px;">Online?</th>
									<th style="width: 100px;">Options</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($char_list as $char_data): ?>
									<tr class="odd gradeX">
										<td><a href="<?php echo base_url('character/details/'.$char_data['char_id'].''); ?>"><?php echo $char_data['char_id']; ?></a></td>
										<td><?php echo $char_data['name']; ?></td>
										<td><?php echo $char_data['sex']; ?></td>
										<td><?php echo $class_list[$char_data['class']]; ?></td>
										<td><?php echo $char_data['base_level']; ?>/<?php echo $char_data['job_level']; ?></td>
										<td><a href="<?php echo base_url('guild/details/'.$char_data['guild_id'].''); ?>"><?php echo $char_data['guild_name']; ?></a></td>
										<td><a href="<?php echo base_url('party/details/'.$char_data['party_id'].''); ?>"><?php echo $char_data['party_name']; ?></a></td>
										<td><?php if ($char_data['online'] == 1) { echo "Yes"; } elseif ($char_data['online'] == 0) { echo "No"; }?></td>
										<td><a href="<?php echo base_url('character/resetpos/'.$char_data['char_id'].''); ?>" class="btn btn-sm btn-success <?php if ($char_data['delete_date'] > 0) { echo "disabled"; } ?>">Reset Position</a>&nbsp;<?php if ($char_data['delete_date'] > 0) { ?><button class="btn btn-danger btn-xs disabled">DELETION PENDING</button><?php } ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>