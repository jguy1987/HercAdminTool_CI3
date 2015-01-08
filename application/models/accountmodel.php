<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db_ragnarok->where('sex !=', 'S');
		$query = $this->db_ragnarok->get('login');
		return $query->result();
	}
}