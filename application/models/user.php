<?php
Class User extends CI_Model {
	function login($username, $passwd) {
		$this->db->select('id, username, passwd, groupid, lastlogin, active');
		$this->db->from('users');
		$this->db->where('username', $username);
		$this->db->where('passwd', MD5($passwd));
		$this->db->limit(1);
	 
		$query = $this->db->get();
	 
		if($query->num_rows() == 1) {
		  return $query->result();
		}
		else {
		  return false;
		}
	}
}
?>