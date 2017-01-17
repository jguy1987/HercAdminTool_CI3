<div id="page-wrapper">	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Bugtracker</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<a href="/bugtracker/newbug" class="btn btn-info">Submit Bug</a>&nbsp;<a href="/bugtracker/config" class="btn btn-warning">Config Tracker</a><br /><br />
		<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseBugsearch" aria-controls="collapseBugsearch">Filter Bugs</button><br />
		<div class="collapse" id="collapseBugsearch">
			<div class="card card-block">
				<?php echo form_open('/bugtracker/buglist', array('class' => 'form-inline')); ?>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
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
						<td><a href="/bugtracker/details/<?php echo $bug_data['bug_id']; ?>"><?php echo $bug_data['bug_id']; ?></a></td>
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