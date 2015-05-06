<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Guilds</h1>
			</div>
		</div>
	</div>
	<p>Listing in-game guilds. Click on the edit button or the Guild ID to edit that guild.</p>
	<div class="panel-body">
		<button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#accordion" href="#searchCollapse">Search Guilds</button>
		<div id="searchCollapse" class="panel-collapse collapse">
			<?php echo form_open('guild/search', array('class' => 'form-inline')); ?>
				<div class="row">
					<div class="col-md-3">
						<label>Guild ID</label>
						<input type="number" name="guild_id" />
					</div>
					<div class="col-md-3">
						<label>Guild Name</label>
						<input type="text" name="guild_name" />
					</div>
					<div class="col-md-3">
						<label>Leader Name</label>
						<input type="text" name="leader_name" />
					</div>
					<div class="col-md-3">
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
					</div>
					<div class="col-md-3">
						<label>Guild Level</label>
						<=<input type="number" name="gtLevel" style="max-width:100px;">&nbsp;>=<input type="number" name="ltLevel" style="max-width:100px;">
					</div>
				</div>
				<div class="row">
					<center><button type="submit" class="btn btn-success">Submit search</button></center>
				</div>
			<?php echo form_close(); ?>
			<br />
		</div>
		<?php echo validation_errors(); ?>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
				<thead>
					<tr>
						<th>Guild ID</th>
						<th>Guild Name</th>
						<th>Guild Master</th>
						<th>Guild Members</th>
						<th>Guild Level</th>
						<th>Options</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($guild_list as $guild) { ?>
						<tr>
							<td><a href="/guild/details/<?php echo $guild['guild_id']; ?>"><?php echo $guild['guild_id']; ?></a></td>
							<td><?php echo $guild['name']; ?></td>
							<td><a href="/character/details/<?php echo $guild['char_id']; ?>"><?php echo $guild['master']; ?></a></td>
							<td><?php echo $guild['member_cnt']; ?></td>
							<td><?php echo $guild['guild_lv']; ?></td>
							<td></td>
						</tr>
					<?php	} ?>
				</tbody>
			</table>
		</div>
	</div>
</div>