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
					<div class="card">
						<div class="card-header">
							<h3>Item Information</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<label for="itemid" class="col-md-3">Item ID</label>
								<div id="itemid" class="col-md-3">
									<?php echo $itemInfo['itemID']; ?>
								</div>
								<label for="invTotal" class="col-md-3">Total In inventories</label>
								<div id="invTotal" class="col-md-3">
									<?php echo $itemInfo['invTotal']; ?>
								</div>
							</div>
							<div class="row">
								<label for="itemname" class="col-md-3">Item Name</label>
								<div id="itemname" class="col-md-3">
									<?php echo $itemInfo['name']; ?>
								</div>
								<label for="cartTotal" class="col-md-3">Total in Carts</label>
								<div id="cartTotal" class="col-md-3">
									<?php echo $itemInfo['cartTotal']; ?>
								</div>
							</div>
							<div class="row">
								<label for="itemtype" class="col-md-3">Item Type</label>
								<div id="itemtype" class="col-md-3">
									<?php echo $item_types[$itemInfo['typeid']]; ?>
								</div>
								<label for="totalItemCount" class="col-md-3">Total in Storages</label>
								<div id="totalItemCount" class="col-md-3">
									<?php echo $itemInfo['storageTotal']; ?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-3">
									<button type="button" class="btn btn-danger">Delete All</button>
								</div>
								<label for="totalQuantity" class="col-md-3">Total Quantity</label>
								<div id="totalQuantity" class="col-md-3">
									<?php echo $itemInfo['totalItemCount']; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h3>Who has the items</h3>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<ul class="nav nav-tabs" id="myTabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="inventoryTab" data-toggle="tab" href="#inventory" role="tab" aria-controls="inventory" aria-selected="true">Inventory</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="storageTab" data-toggle="tab" href="#storage" role="tab" aria-controls="storage" aria-selected="true">Storage</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="col-md-12">
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="inventory" role="tabpanel" aria-labelledby="inventoryTab">
										<div class="row">
											<div class="col-lg-12">
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dt-responsive nowrap" id="inventoryList">
														<thead>
															<th>Char ID</th>
															<th>Char Name</th>
															<th>Account ID</th>
															<th>Base Level</th>
															<th>Class</th>
															<th>Qty In Inventory</th>
															<th>Qty In Cart</th>
															<th>Total Qty</th>
															<th>Options</th>
														</thead>
														<tbody>
															<?php foreach ($inventoryList as $inventoryItem): ?>
																<tr>
																	<td><?php echo $inventoryItem['char_id']; ?></td>
																	<td><?php echo $inventoryItem['name']; ?></td>
																	<td><?php echo $inventoryItem['account_id']; ?></td>
																	<td><?php echo $inventoryItem['base_level']; ?></td>
																	<td><?php echo $class_list[$inventoryItem['class']]; ?></td>
																	<td><?php if ($inventoryItem['inv_amt'] == NULL) { $inventoryItem['inv_amt'] = 0; } echo $inventoryItem['inv_amt']; ?></td>
																	<td><?php if ($inventoryItem['cart_amt'] == NULL) { $inventoryItem['cart_amt'] = 0; } echo $inventoryItem['cart_amt']; ?></td>
																	<td><?php echo $inventoryItem['inv_amt'] + $inventoryItem['cart_amt']; ?></td>
																	<td></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="storage" role="tabpanel" aria-labelledby="storageTab">
										<div class="row">
											<div class="col-lg-12">
												<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover" id="storageList">
														<thead>
															<th>Account ID</th>
															<th>Account Name</th>
															<th>Last Login</th>
															<th>Qty In Storage</th>
															<th>Options</th>
														</thead>
														<tbody>
															<?php foreach ($storageList as $storageItem): ?>
																<tr>
																	<td><?php echo $storageItem['account_id']; ?></td>
																	<td><?php echo $storageItem['userid']; ?></td>
																	<td><?php echo $storageItem['lastlogin']; ?></td>
																	<td><?php echo $storageItem['amount']; ?></td>
																	<td></td>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>