<?php
Class Usermodel extends CI_Model {
	function login($username, $passwd) {
		$this->db->select('id, username, passwd, groupid, lastlogin, disablelogin');
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
	
	function update_user_module($userid,$module) {
		$this->db->where('id', $userid);
		$this->db->update('users', array('lastmodule' => $module));
	}
	
	function update_active($uid) {
		// Update the active date to now.
		$this->db->where('id', $uid);
		$this->db->set('lastlogin', 'NOW()', FALSE);
		$this->db->update('users');
	}
}
?>