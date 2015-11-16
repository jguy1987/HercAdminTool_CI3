<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Item Count List</h1>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<center>
			<p><u>Item Information:</u></p>
			<table>
				<tr>
					<td width="140px"><label>Item ID:</label></td>&nbsp;<td width="140px"><?php echo $itemInfo['itemID']; ?></td>&nbsp;&nbsp;<td width="180px"><label>Total Qty in Inventories:</label></td>&nbsp;<td width="100px"><?php echo $itemInfo['invTotal']; ?></td>
				</tr>
				<tr>
					<td width="140px"><label>Item Name:</label></td>&nbsp;<td width="140px"><?php echo $itemInfo['name']; ?></td>&nbsp;&nbsp;<td width="180px"><label>Total Qty in Carts:</label></td>&nbsp;<td width="100px"><?php echo $itemInfo['cartTotal']; ?></td>
				</tr>
				<tr>
					<td width="140px"><label>Item Type:</label></td>&nbsp;<td width="140px"><?php echo $item_types[$itemInfo['typeid']]; ?></td>&nbsp;&nbsp;<td width="180px"><label>Total Qty in Storages:</label></td>&nbsp;<td width="100px"><?php echo $itemInfo['storageTotal']; ?></td>
				</tr>
				<tr>
					<td width="140px"><button type="button" class="btn btn-danger">Delete All</button></td>&nbsp;<td width="100px"></td>&nbsp;&nbsp;<td width="140px"><label>Total Quantity:</label></td><td width="180px"><?php echo $itemInfo['totalItemCount']; ?></td>
				</tr>
			</table>
			<p>Who has the items:</p>
			<ul class="nav nav-tabs" id="myTabs">
				<li class="active"><a href="#inventory" data-toggle="tab">Inventory</a></li>
				<li><a href="#storage" data-toggle="tab">Storage</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="inventory">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
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
				<div class="tab-pane fade in" id="storage">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="dataTables-listlg">
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
		</center>
	</div>
</div>