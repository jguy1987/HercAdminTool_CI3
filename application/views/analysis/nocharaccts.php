<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-12">
					<div class="breadcrumb-holder">
						<h1 class="main-title float-left">No Character Acct Analysis</h1>
						<ol class="breadcrumb float-right">
							<a href="<?php echo base_url(); ?>" class="breadcrumb-item">Home</a>
							<li class="breadcrumb-item">Analysis</li>
							<li class="breadcrumb-item active">0 Chars on Acctt</li>
						</ol>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col"></div>
				<div class="col-md-9">
					This is a list of all accounts that have not created a character.
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="noCharsAcct">
							<thead>
								<th>Account ID</th>
								<th>Account Name</th>
								<th>Create Date</th>
								<th>Last Login Date</th>
								<th>Banned?</th>
							</thead>
							<tbody>
								<?php foreach($accountresult as $accountEntry): ?>
									<tr>
										<td><?php echo $accountEntry['account_id']; ?></td>
										<td><?php echo $accountEntry['userid']; ?></td>
										<td><?php echo $accountEntry['createdate']; ?></td>
										<td><?php echo $accountEntry['lastlogin']; ?></td>
										<td></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col"></div>
			</div>
		</div>
	</div>
</div>