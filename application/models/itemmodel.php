<?php
Class Itemmodel extends CI_Model {	
	
	function edit_char_item($itemEdit, $itemLoc) {
		$this->db_ragnarok->where('id', $itemEdit['id']);
		unset($itemEdit['id']);
		$this->db_ragnarok->set($itemEdit);
		if ($itemLoc == "inventory") {
			$this->db_ragnarok->update('inventory');
		}
		elseif ($itemLoc == "cart") {
			$this->db_ragnarok->update('cart_inventory');
		}
		elseif ($itemLoc == "storage") {
			$this->db_ragnarok->updatE('storage');
		}
	}
	
	function check_if_card($cardid) {
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->where('id', $cardid);
		$this->db_ragnarok->where('type', 6);
		$q = $this->db_ragnarok->get('item_db');
		$q_count = $q->num_rows();
		/*
		$this->db_ragnarok->select('*');
		$this->db_ragnarok->where('id', $cardid);
		$this->db_ragnarok->where('type', 6);
		$q2 = $this->db_ragnarok->get('item_db2');
		$q2_count = $q2->num_rows(); */
		$q2_count = 0;
		
		if ($q_count == 0 && $q2_count == 0) {
			return false;
		}
		else {
			return true;
		}
	}
}