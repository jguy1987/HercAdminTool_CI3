<?php
Class Accounts extends CI_Model {
	function list_accounts() {
		$query = $this->db->get('login');
	}
}