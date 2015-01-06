<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db->where('sex !=', 'S');
		$query = $this->db->get('login');
		return $query->result();
	}
}