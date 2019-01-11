<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">Guilds</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<a href="<?php echo base_url('guild/search'); ?>" class="breadcrumb-item">Guild</a>
							<li class="breadcrumb-item active">Search</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-sm-3">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dt-default">
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
										<td><a href="<?php echo base_url('guild/details/'.$guild['guild_id'].''); ?>"><?php echo $guild['guild_id']; ?></a></td>
										<td><?php echo $guild['name']; ?></td>
										<td><a href="<?php echo base_url('character/details/'.$guild['char_id'].''); ?>"><?php echo $guild['master']; ?></a></td>
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
		</div>
	</div>
</div>