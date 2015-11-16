<?php
Class Analysismodel extends CI_Model {
	
	function get_itemcount($itemID) { 
	// This function takes the input of an Item ID and outputs who has the item and how much.
	
	// Initialize a couple of arrays:
	$item_infoReturn = array();
	$playersReturn = array();
	
	// First, grab the item information from the database...
	$this->db_charmap->select('id,name_japanese,type');
	$q_iteminfo = $this->db_charmap->get_where('item_db', array('id' => $itemID));
	$iteminfo = $q_iteminfo->row();
	$item_infoReturn['itemID'] = $itemID;
	$item_infoReturn['name'] = $iteminfo->name_japanese;
	$item_infoReturn['typeid'] = $iteminfo->type;
	
	// Next, find out how many items exist in inventories total
	$this->db_charmap->select_sum('amount', 'invCount');
	$this->db_charmap->where('nameid', $itemID);
	$invtotal = $this->db_charmap->get('inventory');
	$invtotal_result = $invtotal->row();
	$item_infoReturn['invTotal'] = $invtotal_result->invCount;
	
	// Next, find out how many characters on the server have this item.
	$this->db_charmap->where('nameid', $itemID);
	$this->db_charmap->from('inventory');
	$item_infoReturn['invCount'] = $this->db_charmap->count_all_results();
	
	// Next, find out how many items exist in cart inventories total
	$this->db_charmap->select_sum('amount', 'cartCount');
	$this->db_charmap->where('nameid', $itemID);
	$carttotal = $this->db_charmap->get('cart_inventory');
	$carttotal_result = $carttotal->row();
	$item_infoReturn['cartTotal'] = $carttotal_result->cartCount;
	
	// Next, find out how many characters on the server have this item in their carts
	$this->db_charmap->where('nameid', $itemID);
	$this->db_charmap->from('cart_inventory');	
	$item_infoReturn['cartCount'] = $this->db_charmap->count_all_results();
	
	// Now, need to figure out how many are in storage total
	$this->db_login->select_sum('amount', 'storageCount');
	$this->db_login->where('nameid', $itemID);
	$storagetotal = $this->db_login->get('storage');
	$storagetotal_result = $storagetotal->row();
	$item_infoReturn['storageTotal'] = $storagetotal_result->storageCount;
	
	// Now, build a list of all of the characters on the server that have this item,
	// where the item is and how much they have of it. Select online status so if need
	// be, the item can be immediately deleted.
	
	// In inventories (cart and char)
	$this->db_charmap->select('char.char_id,char.name,char.base_level,char.class,char.account_id,inventory.id AS inv_id,inventory.nameid AS inv_nameid,inventory.amount AS inv_amt,cart_inventory.id AS cart_id,cart_inventory.nameid AS cart_nameid,cart_inventory.amount AS cart_amt');
	$this->db_charmap->from('char');
	$this->db_charmap->join('inventory', "char.char_id = inventory.char_id AND inventory.nameid = '".$itemID."'", 'left');
	$this->db_charmap->join('cart_inventory', "char.char_id = cart_inventory.char_id AND cart_inventory.nameid = '".$itemID."'", 'left');
	$this->db_charmap->where("inventory.nameid IS NOT NULL",  null, false);
	$this->db_charmap->or_where("cart_inventory.nameid IS NOT NULL", null, false);
	$this->db_charmap->order_by('char.char_id', 'asc'); 
	$inventorylist_q = $this->db_charmap->get();
	$inventoryListReturn = $inventorylist_q->result_array();	
	
	// In storages
	$this->db_charmap->select('login.account_id,login.userid,login.lastlogin,storage.amount,storage.id');
	$this->db_charmap->from('login');
	$this->db_charmap->join('storage', "login.account_id = storage.account_id AND storage.nameid = '".$itemID."'", 'left');
	$this->db_charmap->where("storage.nameid IS NOT NULL", null, false);
	$this->db_charmap->order_by('login.account_id', 'asc');
	$storagelist_q = $this->db_charmap->get();
	$storageListReturn = $storagelist_q->result_array();
	
	// Determine total number of items on the server by the results above.
	$item_infoReturn['totalItemCount'] = $item_infoReturn['invTotal'] + $item_infoReturn['cartTotal'] + $item_infoReturn['storageTotal'];
	
	// And return an array with all of the results:
	return array($item_infoReturn, $inventoryListReturn, $storageListReturn);
	}
	
	function get_lv1_1mzeny() {
		// Returns a list of all characters that are level 1 that have more than 1m zeny.
		$this->db_charmap->select('char.char_id,char.name,char.zeny,char.class,login.account_id,login.lastlogin');
		$this->db_charmap->from('char');
		$this->db_charmap->join('login', 'char.account_id = login.account_id');
		$this->db_charmap->where('char.zeny > 1000000');
		$this->db_charmap->where('char.base_level', '1');
		$this->db_charmap->order_by('zeny', 'desc');
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
	
	function getnocharaccts() {
		// Returns a list of accounts with no characters created on them.
		$this->db_charmap->select('login.*');
		$this->db_charmap->from('login');
		$this->db_charmap->join('char', 'char.account_id = login.account_id', 'left outer');
		$this->db_charmap->where('char.account_id IS NULL', null, false);
		$q = $this->db_charmap->get();
		return $q->result_array();
	}
}