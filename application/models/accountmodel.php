<?php
Class Accountmodel extends CI_Model {
	
	function list_accounts() {
		$this->db_ragnarok->where('sex !=', 'S');
		$query = $this->db_ragnarok->get('login');
		return $query->result();
	}
	
	function add_account($data) {
		// First, need to generate new password.
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&';
		$newPass = '';
		$pincode = '';
		for ($i = 0; $i < 15; $i++) {
			$newPass .= $chars[rand(0, strlen($chars) - 1)];
		}
		$pinchars = '0123456789';
		for ($i = 0; $i < 4; $i++) {
			$pincode .= $pinchars[rand(0, strlen($pinchars) - 1)];
		}
		$newPassMD5 = md5($newPass);
		
		$newAcct = array(
			'passwd'		=> $newPass,
			'pincode'	=> $pincod,
		);	
		$this->db_ragnarok->set('user_pass', $newPassMD5);
		$this->db_ragnarok->set('createdate', 'NOW()', FALSE);
		$this->db_ragnarok->insert('login', $data);
		return $newAcct;
	}
}