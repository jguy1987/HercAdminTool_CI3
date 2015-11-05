<?php
Class Gamelogmodel extends CI_Model {

	function get_atcmd_log() {
		$this->db_charmaplog->select('*');
		$this->db_charmaplog->order_by('atcommand_date', 'desc');
		$q = $this->db_charmaplog->get('atcommandlog');
		return $q->result_array();
	}
	
	function get_atcmd_search($atcmdSearch) {
		$this->db_charmaplog->select('*');
		$this->db_charmaplog->order_by('atcommand_date', 'desc');
		if (empty($atcmdSearch['char_name']) == false) {
			$this->db_charmaplog->like('char_name', $atcmdSearch['char_name']);
		}
		if (empty($atcmdSearch['atcmd']) == false) {
			$this->db_charmaplog->like('command', $atcmdSearch['atcmd']);
		}
		if (empty($atcmdSearch['map']) == false) {
			$this->db_charmaplog->like('map', $atcmdSearch['map']);
		}
		if (empty($atcmdSearch['date_start']) == false) {
			$this->db_charmaplog->where('atcommand_date >=', $atcmdSearch['date_start']);
		}
		if (empty($atcmdSearch['date_end']) == false) {
			$this->db_charmaplog->where('atcommand_date <=', $atcmdSearch['date_end']);
		}
		$q = $this->db_charmaplog->get('atcommandlog');
		return $q->result_array();
	}
	
	function get_pick_search($pickSearch) {
		// First, if we have a character name entered and NOT an ID, we need to get the ID of that char name
		if (empty($pickSearch['char_name']) == false && empty($pickSearch['char_id']) == true) { // User entered a char name and NOT an ID
			if (substr($pickSearch['char_name'], 0, 1) == "=") { // If the user wants to search specifically for that character...
				$nameSearch = substr($pickSearch['char_name'], 1);
				$q = $this->db_charmap->get_where('char', array('name' => $nameSearch));
				$char_id_q = $q->row();
				// now, the ID should be stored in $char_id_q->char_id
				// We can go ahead and initialize the query structure here too.
				$this->db_charmaplog->select('*');
				$this->db_charmaplog->order_by('time', 'desc');
				// And start the search too.
				$this->db_charmaplog->where('char_id', $char_id_q->char_id);
				echo "1";
			}
			elseif (substr($pickSearch['char_name'], 0, 1) != "=") { // The user wants to search wildcard for that character...
				$char_ids = array(); // Make a blank array for the char_id's to select
				$this->db_charmap->select('char_id');
				$this->db_charmap->like('name', $pickSearch['char_name']);
				$q = $this->db_charmap->get('char');
				foreach($q->result_array() as $r) {
					$char_ids[] += $r['char_id'];
				}
				// Now, char_ids contains a full array of all the charid's we need to search on.
				// We can go ahead and initialize the query structure here too...
				$this->db_charmaplog->select('*');
				$this->db_charmaplog->order_by('time', 'desc');
				// And start the search too.
				foreach($char_ids as $id) {
					$this->db_charmaplog->or_where('char_id', $id);
				}
				echo "2";
			}
		}
		else if (empty($pickSearch['char_id']) == false) { // User entered char ID, regardless if they entered a Charname
			$this->db_charmaplog->select('*');
			$this->db_charmaplog->order_by('time', 'desc');
			if (substr($pickSearch['char_id'], 0, 1) == "=") { // User wants to search specifically for that ID
				$charidSearch = substr($pickSearch['char_id'], 1);
				$this->db_charmaplog->where('char_id', $charidSearch);
			}
			else {
				$this->db_charmaplog->like('char_id', $pickSearch['char_id']);
			}
		}
		else { // All the fields are empty or an error, default to start query.
			$this->db_charmaplog->select('*');
			$this->db_charmaplog->order_by('time', 'desc');
			echo "3";
		}
		// Next, if the array $pickSearch['types'] is populated, we need to search for everything in it.
		if (empty($pickSearch['types']) == false) {
			foreach($pickSearch['types'] as $type) {
				$this->db_charmaplog->or_where('type', $type);
			}
			echo "4";
		}
		// Dates...
		if (empty($pickSearch['date_start']) == false) {
			$this->db_charmaplog->where('time >=', $pickSearch['date_start']);
			echo "5";
		}
		if (empty($pickSearch['date_end']) == false) {
			$this->db_charmaplog->where('time <=', $pickSearch['date_end']);
			echo "6";
		}
		// Map:
		if (empty($pickSearch['map']) == false) {
			if (substr($pickSearch['map'], 0, 1) == "=") { // If the user wants to search specifically for that map...
				$this->db_charmaplog->where('map', $atcmdSearch['map']);
			}
			else {
				$this->db_charmaplog->like('map', $atcmdSearch['map']);
			}
			echo "7";
		}
		//and card ids. Did user search for any?
		if (empty($pickSearch['card_id']) == false) {
			// User search for cards. You can enter multiple. Explode on comma:
			$card_id = explode($pickSearch['card_id'], ',');
			// now, we have an array of cards. Let's search on all of them.
			foreach($card_id as $id) {
				$this->db_charmaplog->where('card0', $id);
				$this->db_charmaplog->where('card1', $id);
				$this->db_charmaplog->where('card2', $id);
				$this->db_charmaplog->where('card3', $id);
			}
			echo "8";
		}
		// and Unique ID
		if (empty($pickSearch['unique_id']) == false) {
			if (substr($pickSearch['char_name'], 0, 1) == "=") { 
				$this->db_charmaplog->where('unique_id', $pickSearch['unique_id']);
			}
			else {
				$this->db_charmaplog->like('unique_id', $pickSearch['unique_id']);
			}
			echo "9";
		}
		// Finally, generate and return the results:
		$this->db_charmaplog->limit('10000'); // Limit amount of entries. Too much data == no loading.
		$q = $this->db_charmaplog->get('picklog');
		echo "A";
		return $q->result_array();
	}
}