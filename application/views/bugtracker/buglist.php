<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Bugtracker</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Developer</li>
							<li class="breadcrumb-item active">Bugtracker</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<a href="<?php echo base_url('bugtracker/newbug'); ?>" class="btn btn-info">Submit Bug</a>&nbsp;<a href="<?php echo base_url('bugtracker/config'); ?>" class="btn btn-warning">Config Tracker</a><br /><br />
					<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseBugsearch" aria-controls="collapseBugsearch">Filter Bugs</button><br />
					<div class="collapse" id="collapseBugsearch">
						<div class="card card-block">
							<?php echo form_open('bugtracker/buglist', array('class' => 'form-inline')); ?>
							<?php echo form_close(); ?>
						</div>
					</div>
					<br />
					<table class="table table-striped table-bordered table-hover" id="bugList">
						<thead>
							<tr>
								<th style="width: 75px;">Bug ID</th>
								<th style="width: 225px;">Title</th>
								<th style="width: 30px;">Reporter</th>
								<th style="width: 100px;">Server</th>
								<th style="width: 100px;">Date Started</th>
								<th style="width: 50px;">Version</th>
								<th style="width: 75px;">Status</th>
								<th style="width: 80px;">Priority</th>
								<th style="width: 100px;">Category</th>
								<th style="width: 100px;">Resolution</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($buglist as $bug_data): ?>
								<tr class="odd gradeX">
									<td><a href="<?php echo base_url('bugtracker/details/'.$bug_data['bug_id'].''); ?>"><?php echo $bug_data['bug_id']; ?></a></td>
									<td><?php echo $bug_data['title']; ?></td>
									<td><?php echo $bug_data['starter_name']; ?></td>
									<td><?php echo $servers[$bug_data['server']]['servername']; ?></td>
									<td><?php echo $bug_data['startdate']; ?></td>
									<td><?php echo $bug_data['version']; ?></td>
									<td><?php echo $bug_statuses[$bug_data['status']]; ?></td>
									<td><?php echo $bug_priorities[$bug_data['priority']]; ?></td>
									<td><?php echo $bug_categories[$bug_data['category']]; ?></td>
									<td><?php echo $bug_resolutions[$bug_data['resolution']]; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>